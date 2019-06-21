<?php

namespace Extcode\Contacts\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class CompanyRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Finds objects filtered by $piVars['filter']
     *
     * @param array $piVars
     *
     * @return QueryResultInterface|array
     */
    public function findAll($piVars = [])
    {
        // settings
        $query = $this->createQuery();

        $constraints = [];

        // filter
        if (isset($piVars['filter'])) {
            foreach ((array)$piVars['filter'] as $field => $value) {
                if (empty($value)) {
                    continue;
                }

                switch ($field) {
                    case 'searchString':
                        $constraints[] = $query->like('name', '%' . $value . '%');
                }
            }
        }

        // create constraint
        if (!empty($constraints)) {
            $query->matching(
                $query->logicalAnd($constraints)
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
