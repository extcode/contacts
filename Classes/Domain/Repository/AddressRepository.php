<?php

namespace Extcode\Contacts\Domain\Repository;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\AddressSearch;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AddressRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @param AddressSearch $addressSearch
     *
     * @return array
     */
    public function findByDistance(AddressSearch $addressSearch): array
    {
        $companyUids = [];
        $contactUids = [];

        $countries = $this->findCountries();
        $addresses = $this->findAddressesByDistance($addressSearch);

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

        foreach ($addresses as $addressKey => $address) {
            if ($addresses[$addressKey]['contact']) {
                $addresses[$addressKey]['contact'] = $contacts[$address['contact']];
                $addresses[$addressKey]['country'] = $countries[$address['country']];
            }

            if ($addresses[$addressKey]['company']) {
                $addresses[$addressKey]['company'] = $companies[$address['company']];
                $addresses[$addressKey]['country'] = $countries[$address['country']];
            }
        }

        return $addresses;
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

        $categories = $this->getCategories('tx_contacts_domain_model_company', 'category', $ids);
        foreach ($categories as $category) {
            $queryResult[$category['uid_foreign']]['category'] = $category['uid_local'];
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

        $categories = $this->getCategories('tx_contacts_domain_model_contact', 'category', $ids);
        foreach ($categories as $category) {
            $queryResult[$category['uid_foreign']]['category'] = $category['uid_local'];
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
     * @param string $tableName
     * @param string $fieldName
     * @param array $ids
     *
     * @return mixed[]
     */
    protected function getCategories(string $tableName, string $fieldName, array $ids): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getQueryBuilderForTable('sys_category_record_mm');
        $queryResult = $queryBuilder
            ->select('uid_local', 'uid_foreign')
            ->from('sys_category_record_mm')
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
     * @param AddressSearch $addressSearch
     *
     * @return mixed[]
     */
    protected function findAddressesByDistance(AddressSearch $addressSearch): array
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

        if (!empty($addressSearch->getPids())) {
            $queryBuilder
                ->andWhere(
                    $queryBuilder->expr()->in('pid', explode(',', $addressSearch->getPids()))
                );
        }

        if (!empty($addressSearch->getSearchString())) {
            $queryBuilder
                ->andWhere(
                    $queryBuilder->expr()->like(
                        'title',
                        $queryBuilder->createNamedParameter('%' . $queryBuilder->escapeLikeWildcards($addressSearch->getSearchString()) . '%')
                    )
                );
        }

        $addresses = $queryBuilder->execute()->fetchAll();

        if ($addressSearch->getLat() !== 0.0 && $addressSearch->getLon() !== 0.0 && $addressSearch->getRadius() !== 0) {
            $addressesInDistance = [];

            foreach ($addresses as $addressKey => $address) {
                $distance = $this->getDistance($addressSearch->getLat(), $addressSearch->getLon(), $address['lat'], $address['lon']);

                if ($distance < $addressSearch->getRadius()) {
                    $address['distance'] = $distance;

                    $addressesInDistance[(string)$distance] = $address;
                }
            }

            $addresses = $addressesInDistance;
        }

        return $addresses;
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
