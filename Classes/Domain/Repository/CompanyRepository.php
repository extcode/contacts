<?php

namespace Extcode\Contacts\Domain\Repository;

use Extcode\Contacts\Domain\Model\Dto\Demand;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class CompanyRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
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
