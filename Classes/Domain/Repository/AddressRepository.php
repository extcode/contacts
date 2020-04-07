<?php

namespace Extcode\Contacts\Domain\Repository;

use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AddressRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param float $lat
     * @param float $lon
     * @param int $radius
     *
     * @return array
     */
    public function findByDistance(float $lat, float $lon, int $radius): array
    {
        $addressesInDistance = [];

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('tx_contacts_domain_model_address');
        $addresses = $queryBuilder
            ->select('*')
            ->from('tx_contacts_domain_model_address')
            ->where(
                $queryBuilder->expr()->andX(
                    $queryBuilder->expr()->neq('lat', 0.0),
                    $queryBuilder->expr()->neq('lon', 0.0)
                )
            )
            ->execute()->fetchAll();

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

        $contactUids = array_column($addresses, 'uid', 'contact');
        unset($contactUids[0]);
        $contactUids = array_flip($contactUids);

        $companyUids = array_column($addresses, 'uid', 'company');
        unset($companyUids[0]);
        $companyUids = array_flip($companyUids);

        $contacts = $this->getContacts('tx_contacts_domain_model_contact', $contactUids);
        $companies = $this->getContacts('tx_contacts_domain_model_company', $companyUids);

        foreach ($addressesInDistance as $distance => $address) {
            if ($addressesInDistance[$distance]['contact']) {
                $addressesInDistance[$distance]['contact'] = $contacts[$address['contact']];
            }

            if ($addressesInDistance[$distance]['company']) {
                $addressesInDistance[$distance]['company'] = $companies[$address['company']];
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

        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable($tableName);
        $queryResult = $queryBuilder
            ->select('*')
            ->from($tableName)
            ->where(
                $queryBuilder->expr()->in('uid', $ids)
            )
            ->execute()->fetchAll();

        $uids = array_column($queryResult, 'uid');
        $queryResult = array_combine($uids, $queryResult);

        if ($tableName === 'tx_contacts_domain_model_contact') {
            $type = 'contact';
        } elseif ($tableName === 'tx_contacts_domain_model_company') {
            $type = 'company';
        }

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
}
