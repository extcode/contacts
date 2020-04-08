<?php

namespace Extcode\Contacts\Domain\Repository;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AddressRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param float $lat
     * @param float $lon
     * @param int $radius
     * @param int $pid
     * @param string $searchWord
     *
     * @return array
     */
    public function findByDistance(float $lat, float $lon, int $radius, int $pid, string $searchWord): array
    {
        $addressesInDistance = [];

        $companyAddresses = $this->findCompanyAddressesByDistance($searchWord);
        $contactAddresses = $this->findContactAddressesByDistance($searchWord);
        $countries = $this->findCountries();

        if ($lat === 0.0 || $lon === 0.0 || $radius === 0) {
            $uids = array_column($companyAddresses, 'uid');
            $companyAddresses = array_combine($uids, $companyAddresses);

            $uids = array_column($contactAddresses, 'uid');
            $contactAddresses = array_combine($uids, $contactAddresses);

            $addressesInDistance = $companyAddresses + $contactAddresses;
        } else {
            foreach ($companyAddresses as $address) {
                $distance = $this->getDistance($lat, $lon, $address['lat'], $address['lon']);

                if ($distance < $radius) {
                    $address['distance'] = $distance;

                    $addressesInDistance[(string)$distance] = $address;
                }
            }
            foreach ($contactAddresses as $address) {
                $distance = $this->getDistance($lat, $lon, $address['lat'], $address['lon']);

                if ($distance < $radius) {
                    $address['distance'] = $distance;

                    $addressesInDistance[(string)$distance] = $address;
                }
            }
        }

        $companyUids = array_column($companyAddresses, 'uid', 'company');
        unset($companyUids[0]);
        $companyUids = array_flip($companyUids);

        $contactUids = array_column($contactAddresses, 'uid', 'contact');
        unset($contactUids[0]);
        $contactUids = array_flip($contactUids);

        $companies = $this->getContacts('tx_contacts_domain_model_company', $companyUids);
        $contacts = $this->getContacts('tx_contacts_domain_model_contact', $contactUids);

        foreach ($addressesInDistance as $distance => $address) {
            if ($addressesInDistance[$distance]['contact']) {
                $addressesInDistance[$distance]['contact'] = $contacts[$address['contact']];
                $addressesInDistance[$distance]['country']= $countries[$address['country']];
            }

            if ($addressesInDistance[$distance]['company']) {
                $addressesInDistance[$distance]['company'] = $companies[$address['company']];
                $addressesInDistance[$distance]['country']= $countries[$address['country']];
            }
        }

        ksort($addressesInDistance);

        return $addressesInDistance;
    }

    /**
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     *
     * @return float $distance
     */
    public function getDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $l1 = deg2rad($lat1);
        $o1 = deg2rad($lon1);
        $l2 = deg2rad($lat2);
        $o2 = deg2rad($lon2);

        $radius = 6372.795;
        $distance = 2 * $radius * asin(
            min(
                1,
                sqrt((sin(($l2 - $l1) / 2) ** 2) + cos($l1) * cos($l2) * (sin(($o2 - $o1) / 2) ** 2))
            )
        );

        return $distance;
    }

    /**
     * @param string $tableName
     * @param array $ids
     *
     * @return array
     */
    protected function getContacts(string $tableName, array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        if ($tableName === 'tx_contacts_domain_model_contact') {
            $type = 'contact';
        } elseif ($tableName === 'tx_contacts_domain_model_company') {
            $type = 'company';
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($tableName);
        $queryBuilder
            ->select('*')
            ->from($tableName)
            ->where(
                $queryBuilder->expr()->in('uid', $ids)
            );

        $queryResult = $queryBuilder->execute()->fetchAll();

        $uids = array_column($queryResult, 'uid');
        $queryResult = array_combine($uids, $queryResult);

        if ($type) {
            $phones = $this->getPhones($type, $ids);

            foreach ($phones as $phone) {
                if (is_numeric($queryResult[$phone[$type]]['phone'])) {
                    $queryResult[$phone[$type]]['phone'] = [];
                }
                $queryResult[$phone[$type]]['phone'][] = $phone;
            }
        }

        return $queryResult;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return array
     */
    protected function getPhones(string $type, array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_contacts_domain_model_phone');
        $queryResult = $queryBuilder
            ->select('*')
            ->from('tx_contacts_domain_model_phone')
            ->where(
                $queryBuilder->expr()->in($type, $ids)
            )
            ->execute()->fetchAll();

        $uids = array_column($queryResult, 'uid');
        $queryResult = array_combine($uids, $queryResult);

        return $queryResult;
    }

    /**
     * @param string $searchWord
     *
     * @return mixed[]
     */
    protected function findCompanyAddressesByDistance(string $searchWord)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_contacts_domain_model_address');
        $queryBuilder
            ->select('tx_contacts_domain_model_address.*')
            ->from('tx_contacts_domain_model_address')
            ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->neq('lat', 0.0),
                    $queryBuilder->expr()->neq('lon', 0.0)
                )
            );

        if (!empty($searchWord)) {
            $queryBuilder
                ->join(
                    'tx_contacts_domain_model_address',
                    'tx_contacts_domain_model_company',
                    'company',
                    $queryBuilder->expr()->eq('tx_contacts_domain_model_address.company', $queryBuilder->quoteIdentifier('company.uid'))
                )
                ->join(
                    'company',
                    'sys_file_reference',
                    'sysfileref',
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->eq('company.uid', $queryBuilder->quoteIdentifier('sysfileref.uid_foreign')),
                        $queryBuilder->expr()->eq('sysfileref.tablenames', $queryBuilder->createNamedParameter('tx_contacts_domain_model_company')),
                        $queryBuilder->expr()->eq('sysfileref.fieldname', $queryBuilder->createNamedParameter('logo'))
                    )
                )
                ->addSelect('sysfileref.uid as sys_file_reference_id')
                ->andWhere(
                    $queryBuilder->expr()->like(
                        'company.name',
                        $queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards($searchWord) . '%')
                    )
                );
        }

        return $queryBuilder->execute()->fetchAll();
    }

    /**
     * @param string $searchWord
     *
     * @return mixed[]
     */
    protected function findContactAddressesByDistance(string $searchWord)
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_contacts_domain_model_address');
        $queryBuilder
            ->select('tx_contacts_domain_model_address.*')
            ->from('tx_contacts_domain_model_address')
            ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->neq('lat', 0.0),
                    $queryBuilder->expr()->neq('lon', 0.0)
                )
            );

        if (!empty($searchWord)) {
            $queryBuilder
                ->join(
                    'tx_contacts_domain_model_address',
                    'tx_contacts_domain_model_contact',
                    'contact',
                    $queryBuilder->expr()->eq('tx_contacts_domain_model_address.contact', $queryBuilder->quoteIdentifier('contact.uid'))
                )
                ->join(
                    'contact',
                    'sys_file_reference',
                    'sysfileref',
                    $queryBuilder->expr()->andX(
                        $queryBuilder->expr()->eq('contact.uid', $queryBuilder->quoteIdentifier('sysfileref.uid_foreign')),
                        $queryBuilder->expr()->eq('sysfileref.tablenames', $queryBuilder->createNamedParameter('tx_contacts_domain_model_contact')),
                        $queryBuilder->expr()->eq('sysfileref.fieldname', $queryBuilder->createNamedParameter('photo'))
                    )
                )
                ->addSelect('sysfileref.uid as sys_file_reference_id')
                ->andWhere(
                    $queryBuilder->expr()->orX(
                        $queryBuilder->expr()->like(
                            'contact.first_name',
                            $queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards($searchWord) . '%')
                        ),
                        $queryBuilder->expr()->like(
                            'contact.last_name',
                            $queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards($searchWord) . '%')
                        )
                    )
                );
        }

        return $queryBuilder->execute()->fetchAll();
    }

    /**
     * @return mixed[]
     */
    protected function findCountries()
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_contacts_domain_model_country');
        $queryResult = $queryBuilder
            ->select('uid', 'pid', 'iso2', 'iso3', 'name', 'tld', 'phone_country_code')
            ->from('tx_contacts_domain_model_country')
            ->execute()
            ->fetchAll();

        $uids = array_column($queryResult, 'uid');
        $queryResult = array_combine($uids, $queryResult);

        return $queryResult;
    }
}
