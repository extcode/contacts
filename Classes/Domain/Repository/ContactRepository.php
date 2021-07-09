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

class ContactRepository extends Repository
{
    public function findDemanded(Demand $demand): QueryResultInterface
    {
        // settings
        $query = $this->createQuery();

        $constraints = [];

        if (!empty($demand->getSearchString())) {
            $constraints[] = $query->like('firstName', '%' . $demand->getSearchString() . '%');
            $constraints[] = $query->like('lastName', '%' . $demand->getSearchString() . '%');
        }

        if (!empty($demand->getAvailableCategories())) {
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

    public function findByUids(string $uids): array
    {
        $uids = explode(',', $uids);

        $query = $this->createQuery();
        $query->getQuerySettings()->setRespectStoragePage(false);

        $query->matching(
            $query->in('uid', $uids)
        );

        return $this->orderByField($query->execute(), $uids);
    }

    protected function orderByField(QueryResultInterface $contacts, array $uids): array
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
