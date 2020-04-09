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

        $addresses = $this->findAddressesByDistance($searchWord);
        $countries = $this->findCountries();

        if ($lat === 0.0 || $lon === 0.0 || $radius === 0) {
            $addressesInDistance = $addresses;
        } else {
            foreach ($addresses as $address) {
                $distance = $this->getDistance($lat, $lon, $address['lat'], $address['lon']);

                if ($distance < $radius) {
                    $address['distance'] = $distance;

                    $addressesInDistance[(string)$distance] = $address;
                }
            }
        }

        $companyUids = [];
        $contactUids = [];

        foreach ($addresses as $address) {
            if ((int)$address['company'] > 0) {
                $companyUids[] = (int)$address['company'];
            }
            if ((int)$address['contact'] > 0) {
                $contactUids[] = (int)$address['contact'];
            }
        }

        $companies = $this->getCompanyData($companyUids);
        $contacts = $this->getContactData($contactUids);

        foreach ($addressesInDistance as $distance => $address) {
            if ($addressesInDistance[$distance]['contact']) {
                $addressesInDistance[$distance]['contact'] = $contacts[$address['contact']];
                $addressesInDistance[$distance]['country'] = $countries[$address['country']];
            }

            if ($addressesInDistance[$distance]['company']) {
                $addressesInDistance[$distance]['company'] = $companies[$address['company']];
                $addressesInDistance[$distance]['country'] = $countries[$address['country']];
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
     * @param array $ids
     *
     * @return array
     */
    protected function getCompanyData(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_contacts_domain_model_company');
        $queryBuilder
            ->select('*')
            ->from('tx_contacts_domain_model_company')
            ->where(
                $queryBuilder->expr()->in('uid', $ids)
            );

        $queryResult = $queryBuilder->execute()->fetchAll();

        $uids = array_column($queryResult, 'uid');
        $queryResult = array_combine($uids, $queryResult);

        $phones = $this->getPhones('company', $ids);
        foreach ($phones as $phone) {
            if (is_numeric($queryResult[$phone['company']]['phone'])) {
                $queryResult[$phone['company']]['phone'] = [];
            }
            $queryResult[$phone['company']]['phone'][] = $phone;
        }

        $logos = $this->getImages('tx_contacts_domain_model_company', 'logo', $ids);
        foreach ($logos as $logo) {
            $queryResult[$logo['uid_foreign']]['sys_file_reference_id'] = $logo['uid'];
        }

        return $queryResult;
    }

    /**
     * @param string $tableName
     * @param array $ids
     *
     * @return array
     */
    protected function getContactData(array $ids): array
    {
        if (empty($ids)) {
            return [];
        }

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_contacts_domain_model_contact');
        $queryBuilder
            ->select('*')
            ->from('tx_contacts_domain_model_contact')
            ->where(
                $queryBuilder->expr()->in('uid', $ids)
            );

        $queryResult = $queryBuilder->execute()->fetchAll();

        $uids = array_column($queryResult, 'uid');
        $queryResult = array_combine($uids, $queryResult);

        $phones = $this->getPhones('contact', $ids);
        foreach ($phones as $phone) {
            if (is_numeric($queryResult[$phone['contact']]['phone'])) {
                $queryResult[$phone['contact']]['phone'] = [];
            }
            $queryResult[$phone['contact']]['phone'][] = $phone;
        }

        $photos = $this->getImages('tx_contacts_domain_model_contact', 'photo', $ids);
        foreach ($photos as $photo) {
            $queryResult[$photo['uid_foreign']]['sys_file_reference_id'] = $photo['uid'];
        }

        return $queryResult;
    }

    /**
     * @param string $type
     * @param array $ids
     * @return mixed[]
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
     * @param string $tableName
     * @param string $fieldName
     * @param array $ids
     *
     * @return mixed[]
     */
    protected function getImages(string $tableName, string $fieldName, array $ids): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_file_reference');
        $queryResult = $queryBuilder
            ->select('uid', 'uid_foreign')
            ->from('sys_file_reference')
            ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->eq('tablenames', $queryBuilder->createNamedParameter($tableName)),
                    $queryBuilder->expr()->eq('fieldname', $queryBuilder->createNamedParameter($fieldName)),
                    $queryBuilder->expr()->in('uid_foreign', $ids)
                )
            )
            ->execute()->fetchAll();

        $uids = array_column($queryResult, 'uid_foreign');
        $queryResult = array_combine($uids, $queryResult);

        return $queryResult;
    }

    /**
     * @param string $searchWord
     *
     * @return mixed[]
     */
    protected function findAddressesByDistance(string $searchWord): array
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
                ->andWhere(
                    $queryBuilder->expr()->like(
                        'title',
                        $queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards($searchWord) . '%')
                    )
                );
        }

        return $queryBuilder->execute()->fetchAll();
    }

    /**
     * @return mixed[]
     */
    protected function findCountries(): array
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
