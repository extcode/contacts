<?php

namespace Extcode\Contacts\Domain\Model;

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
 * Phone Model
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class Phone extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Type
     *
     * @var string
     */
    protected $type = 'VOICE';

    /**
     * Number
     *
     * @var string
     * @validate NotEmpty
     */
    protected $number = '';

    /**
     * @param string $type
     * @throws \InvalidArgumentException
     */
    public function setType($type)
    {
        $types = [
            'PREF',
            'WORK',
            'HOME',
            'VOICE',
            'FAX',
            'MSG',
            'CELL',
            'PAGER',
            'BBS',
            'MODEM',
            'CAR',
            'ISDN',
            'VIDEO'
        ];

        if (!in_array($type, $types)) {
            throw new \InvalidArgumentException(
                'The type have to be a set of (PREF, WORK, HOME, VOICE, FAX, MSG, CELL, PAGER, BBS, MODEM, CAR, ISDN, VIDEO).',
                1373531068
            );
        }

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }
}
