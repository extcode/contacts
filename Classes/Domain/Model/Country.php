<?php

namespace Extcode\Contacts\Domain\Model;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

class Country extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $iso2 = '';

    /**
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $iso3 = '';

    /**
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $tld = '';

    /**
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $phoneCountryCode = '';

    /**
     * @param string $iso2
     *
     * @throws \TYPO3\CMS\Extbase\Property\Exception
     */
    public function setIso2(string $iso2)
    {
        if (strlen($iso2) != 2) {
            throw new \TYPO3\CMS\Extbase\Property\Exception(
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
     * @throws \TYPO3\CMS\Extbase\Property\Exception
     */
    public function setIso3(string $iso3)
    {
        if ((strlen($iso3) != 0) and (strlen($iso3) != 3)) {
            throw new \TYPO3\CMS\Extbase\Property\Exception(
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
     */
    public function setName(string $name)
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
     */
    public function setTld(string $tld)
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
     */
    public function setPhoneCountryCode(string $phoneCountryCode)
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
