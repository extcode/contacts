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
     * @return Query Object
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

        $contacts = $query->execute();

        return $contacts;
    }

    /**
     * Finds objects based on selected uids
     *
     * @param string $uids
     *
     * @return object
     */
    public function findByUids($uids)
    {
        $uids = explode(',', $uids);

        $query = $this->createQuery();
        $query->matching(
            $query->in('uid', $uids)
        );

        return $query->execute();
    }
}
