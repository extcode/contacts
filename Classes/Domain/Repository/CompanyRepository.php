<?php

namespace Extcode\Contacts\Domain\Repository;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\Demand;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

class CompanyRepository extends Repository
{

    /**
     * @param Demand $demand
     *
     * @return QueryResultInterface|array
     */
    public function findDemanded(Demand $demand)
    {
        // settings
        $query = $this->createQuery();

        $constraints = [];

        if (!empty($demand->getSearchString())) {
            $constraints[] = $query->like('name', '%' . $demand->getSearchString() . '%');
        }

        if ((!empty($demand->getAvailableCategories()))) {
            $categoryConstraints = [];

            if ($demand->getSelectedCategory()) {
                $category = $demand->getSelectedCategory();
                $categoryConstraints[] = $query->contains('category', $category);
                $categoryConstraints[] = $query->contains('categories', $category);
            } else {
                foreach ($demand->getAvailableCategories() as $category) {
                    $categoryConstraints[] = $query->contains('category', $category);
                    $categoryConstraints[] = $query->contains('categories', $category);
                }
            }

            $constraints = $query->logicalOr($categoryConstraints);
        }

        // create constraint
        if (!empty($constraints)) {
            $query->matching(
                $query->logicalAnd(
                    $query->logicalOr($constraints)
                )
            );
        }

        if (!empty($demand->getOrderBy())) {
            $query->setOrderings(
                [
                    $demand->getOrderBy() => QueryInterface::ORDER_ASCENDING
                ]
            );
        }

        return $query->execute();
    }

    /**
     * Finds objects based on selected uids
     *
     * @param string $uids
     *
     * @return array
     */
    public function findByUids($uids)
    {
        $uids = explode(',', $uids);

        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        $query->matching(
            $query->in('uid', $uids)
        );

        return $this->orderByField($query->execute(), $uids);
    }

    /**
     * @param QueryResultInterface $companies
     * @param array $uids
     *
     * @return array
     */
    protected function orderByField(QueryResultInterface $companies, $uids)
    {
        $indexedCompanies = [];
        $orderedCompanies = [];

        // Create an associative array
        foreach ($companies as $object) {
            if ($object->_getProperty('_localizedUid')) {
                $indexedCompanies[$object->_getProperty('_localizedUid')] = $object;
            } else {
                $indexedCompanies[$object->getUid()] = $object;
            }
        }
        // add to ordered array in right order
        foreach ($uids as $uid) {
            if (isset($indexedCompanies[$uid])) {
                $orderedCompanies[] = $indexedCompanies[$uid];
            }
        }

        return $orderedCompanies;
    }
}
