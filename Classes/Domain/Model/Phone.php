<?php

namespace Extcode\Contacts\Domain\Model;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

class Phone extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $type = 'VOICE';

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $number = '';

    /**
     * @param string $type
     * @throws \InvalidArgumentException
     */
    public function setType(string $type)
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
    public function setNumber(string $number)
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
