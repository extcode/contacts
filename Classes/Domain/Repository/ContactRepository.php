<?php

namespace Extcode\Contacts\Domain\Repository;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * Contact Reoository
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class ContactRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
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
                        $constraints[] = $query->like('firstName', '%' . $value . '%');
                        $constraints[] = $query->like('lastName', '%' . $value . '%');
                }
            }
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
     * @param QueryResultInterface $contacts
     * @param array $uids
     *
     * @return array
     */
    protected function orderByField(QueryResultInterface $contacts, $uids)
    {
        $indexedContacts = [];
        $orderedContacts = [];

        // Create an associative array
        foreach ($contacts as $object) {
            if ($object->_getProperty('_localizedUid')) {
                $indexedContacts[$object->_getProperty('_localizedUid')] = $object;
            } else {
                $indexedContacts[$object->getUid()] = $object;
            }
        }
        // add to ordered array in right order
        foreach ($uids as $uid) {
            if (isset($indexedContacts[$uid])) {
                $orderedContacts[] = $indexedContacts[$uid];
            }
        }

        return $orderedContacts;
    }
}
