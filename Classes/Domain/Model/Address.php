<?php

namespace Extcode\Contacts\Domain\Model;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     */
    protected $type = 'INTL,POSTAL,PARCEL,WORK';

    /**
     * @var string
     */
    protected $street = '';

    /**
     * @var string
     */
    protected $streetNumber = '';

    /**
     * @var string
     */
    protected $addition1 = '';

    /**
     * @var string
     */
    protected $addition2 = '';

    /**
     * @var string
     */
    protected $zip = '';

    /**
     * @var string
     */
    protected $city = '';

    /**
     * @var string
     */
    protected $region = '';

    /**
     * @var \Extcode\Contacts\Domain\Model\Country
     */
    protected $country = '';

    /**
     * @var string
     */
    protected $postBox = '';

    /**
     * @var string
     */
    protected $lon = '';

    /**
     * @var string
     */
    protected $lat = '';

    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\TtContent>
     */
    protected $ttContent;

    /**
     * @var \Extcode\Contacts\Domain\Model\Contact
     */
    protected $contact = null;

    /**
     * @var \Extcode\Contacts\Domain\Model\Company
     */
    protected $company = null;

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $type
     *
     * @throws \InvalidArgumentException
     */
    public function setType(string $type)
    {
        $types = ['DOM', 'INTL', 'POSTAL', 'PARCEL', 'HOME', 'WORK'];

        if (!in_array($type, $types)) {
            throw new \InvalidArgumentException(
                'The type have to be a set of (DOM, INTL, POSTAL, PARCEL, HOME, WORK).',
                1373530255
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
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber(string $streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @param string $addition1
     */
    public function setAddition1(string $addition1)
    {
        $this->addition1 = $addition1;
    }

    /**
     * @return string
     */
    public function getAddition1()
    {
        return $this->addition1;
    }

    /**
     * @param string $addition2
     */
    public function setAddition2(string $addition2)
    {
        $this->addition2 = $addition2;
    }

    /**
     * @return string
     */
    public function getAddition2()
    {
        return $this->addition2;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region)
    {
        $this->region = $region;
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
    }

    /**
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $postBox
     */
    public function setPostBox(string $postBox)
    {
        $this->postBox = $postBox;
    }

    /**
     * @return string
     */
    public function getPostBox()
    {
        return $this->postBox;
    }

    /**
     * @param string $lat
     */
    public function setLat(string $lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param string $lon
     */
    public function setLon(string $lon)
    {
        $this->lon = $lon;
    }

    /**
     * @return string
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param Contact $contact
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param Company $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @param ObjectStorage $ttContent
     */
    public function setTtContent(ObjectStorage $ttContent)
    {
        $this->ttContent = $ttContent;
    }

    /**
     * @return ObjectStorage
     */
    public function getTtContent()
    {
        return $this->ttContent;
    }
}
