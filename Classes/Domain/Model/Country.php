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
 * Country Model
 *
 * @package contacts
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class Country extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Iso2
     *
     * @var string
     * @validate NotEmpty
     */
    protected $iso2 = '';

    /**
     * Iso3
     *
     * @var string
     * @validate NotEmpty
     */
    protected $iso3 = '';

    /**
     * Name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';

    /**
     * Tld
     *
     * @var string
     */
    protected $tld = '';

    /**
     * PhoneCountryCode
     *
     * @var string
     * @validate NotEmpty
     */
    protected $phoneCountryCode = '';

    /**
     * @param string $iso2
     *
     * @throws \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException
     *
     * @return void
     */
    public function setIso2($iso2)
    {
        if (strlen($iso2) != 2) {
            throw new \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException(
                'The iso2 code has to have two chars.',
                1395925918
            );
        }

        $this->iso2 = $iso2;
    }

    /**
     * @return string
     */
    public function getIso2()
    {
        return $this->iso2;
    }

    /**
     * @param string $iso3
     *
     * @throws \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException
     *
     * @return void
     */
    public function setIso3($iso3)
    {
        if ((strlen($iso3) != 0) AND (strlen($iso3) != 3)) {
            throw new \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException(
                'The iso3 code has to have three chars.',
                1395925960
            );
        }

        $this->iso3 = $iso3;
    }

    /**
     * @return string
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $tld
     *
     * @return void
     */
    public function setTld($tld)
    {
        $this->tld = $tld;
    }

    /**
     * @return string
     */
    public function getTld()
    {
        return $this->tld;
    }

    /**
     * @param string $phoneCountryCode
     *
     * @return void
     */
    public function setPhoneCountryCode($phoneCountryCode)
    {
        $this->phoneCountryCode = $phoneCountryCode;
    }

    /**
     * @return string
     */
    public function getPhoneCountryCode()
    {
        return $this->phoneCountryCode;
    }
}
