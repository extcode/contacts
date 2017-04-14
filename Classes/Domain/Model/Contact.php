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
 * Contact Model
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class Contact extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Salutation
     *
     * @var string
     */
    protected $salutation;

    /**
     * Title
     *
     * @var string
     */
    protected $title;

    /**
     * First Name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $firstName;

    /**
     * Last Name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $lastName;

    /**
     * Birthday
     *
     * @var int
     */
    protected $birthday = 0;

    /**
     * companies
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Company>
     */
    protected $companies;

    /**
     * addresses
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Address>
     */
    protected $addresses;

    /**
     * Phone Numbers
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Phone>
     */
    protected $phoneNumbers;

    /**
     * email
     *
     * @var string
     */
    protected $email;

    /**
     * uri
     *
     * @var string
     */
    protected $uri;

    /**
     * photo
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $photo = null;

    /**
     * TT Content
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\TtContent>
     * @lazy
     */
    protected $ttContent;

    /**
     * @param $salutation
     * @param $title
     * @param $firstName
     * @param $lastName
     */
    public function __construct($salutation, $title, $firstName, $lastName)
    {
        $this->salutation = $salutation;
        $this->title = $title;
        $this->firstName = $firstName;
        $this->lastName = $lastName;

        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties.
     */
    protected function initStorageObjects()
    {
        $this->companies = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->addresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->phoneNumbers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @param string $salutation
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;
    }

    /**
     * @return string
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
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
     * @param string $firstName
     *
     * @throws \InvalidArgumentException
     */
    public function setFirstName($firstName)
    {
        if (strlen($firstName) == 0) {
            throw new \InvalidArgumentException(
                'The first name can not be blank.',
                1373525114
            );
        }

        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $lastName
     *
     * @throws \InvalidArgumentException
     */
    public function setLastName($lastName)
    {
        if (strlen($lastName) == 0) {
            throw new \InvalidArgumentException(
                'The last name can not be blank.',
                1373525586
            );
        }

        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $seperator
     * @return string
     */
    public function getFullName($seperator = ' ')
    {
        return implode($seperator, [$this->getFirstName(), $this->getLastName()]);
    }

    /**
     * @param string $seperator
     * @return string
     */
    public function getTitleFullName($seperator = ' ')
    {
        $titleFullName = [];
        if ($this->getTitle()) {
            $titleFullName[] = $this->getTitle();
        }
        $titleFullName[] = $this->getFullName($seperator);

        return implode($seperator, $titleFullName);
    }

    /**
     * @param int $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return int
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Adds a Company
     *
     * @param \Extcode\Contacts\Domain\Model\Company $company
     */
    public function addCompany(\Extcode\Contacts\Domain\Model\Company $company)
    {
        $this->companies->attach($company);
    }

    /**
     * Removes a Company
     *
     * @param \Extcode\Contacts\Domain\Model\Company $companyToRemove The Company to be removed
     */
    public function removeCompany(\Extcode\Contacts\Domain\Model\Company $companyToRemove)
    {
        $this->companies->detach($companyToRemove);
    }

    /**
     * Returns the companies
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Company> $companies
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * Sets the companies
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Company> $companies
     */
    public function setCompanies(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $companies)
    {
        $this->companies = $companies;
    }

    /**
     * Adds a Address
     *
     * @param \Extcode\Contacts\Domain\Model\Address $address
     */
    public function addAddress(\Extcode\Contacts\Domain\Model\Address $address)
    {
        $this->addresses->attach($address);
    }

    /**
     * Removes a Address
     *
     * @param \Extcode\Contacts\Domain\Model\Address $addressToRemove The Address to be removed
     */
    public function removeAddress(\Extcode\Contacts\Domain\Model\Address $addressToRemove)
    {
        $this->addresses->detach($addressToRemove);
    }

    /**
     * Returns the addresses
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Address> $addresses
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Sets the addresses
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Address> $addresses
     */
    public function setAddresses(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Adds a Phone Number
     *
     * @param \Extcode\Contacts\Domain\Model\Phone $phoneNumber
     */
    public function addPhoneNumber(\Extcode\Contacts\Domain\Model\Phone $phoneNumber)
    {
        $this->phoneNumbers->attach($phoneNumber);
    }

    /**
     * Removes a Phone Number
     *
     * @param \Extcode\Contacts\Domain\Model\Phone $phoneNumberToRemove The Phone Number to be removed
     */
    public function removePhoneNumber(\Extcode\Contacts\Domain\Model\Phone $phoneNumberToRemove)
    {
        $this->phoneNumbers->detach($phoneNumberToRemove);
    }

    /**
     * Returns the phoneNumbers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Phone> $phoneNumbers
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * Sets the phoneNumbers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Phone> $phoneNumbers
     */
    public function setPhoneNumbers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $phoneNumbers)
    {
        $this->phoneNumbers = $phoneNumbers;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * Returns the photo
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Sets the photo
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $photo
     */
    public function setPhoto(\TYPO3\CMS\Extbase\Domain\Model\FileReference $photo)
    {
        $this->photo = $photo;
    }

    /**
     * Returns the TT Content
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getTtContent()
    {
        return $this->ttContent;
    }

    /**
     * Sets the TT Content
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $ttContent
     */
    public function setTtContent($ttContent)
    {
        $this->ttContent = $ttContent;
    }
}
