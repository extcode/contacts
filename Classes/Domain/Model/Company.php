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
 * Company Model
 *
 * @package contacts
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class Company extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name;

    /**
     * Legal Name
     *
     * @var string
     */
    protected $legalName = '';

    /**
     * Legal Form
     *
     * @var string
     */
    protected $legalForm = '';


    /**
     * Registered Office
     *
     * @var string
     */
    protected $registeredOffice = '';

    /**
     * Register Court
     *
     * @var string
     */
    protected $registerCourt = '';

    /**
     * Register Number
     *
     * @var string
     */
    protected $registerNumber = '';

    /**
     * VAT Id
     *
     * @var string
     */
    protected $vatId = '';

    /**
     * Directors
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact>
     */
    protected $directors;

    /**
     * Contacts
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact>
     */
    protected $contacts;

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
    protected $email = '';

    /**
     * uri
     *
     * @var string
     */
    protected $uri = '';

    /**
     * logo
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $logo = null;

    /**
     * TT Content
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\TtContent>
     * @lazy
     */
    protected $ttContent;

    /**
     * @param $name
     */
    public function __construct($name)
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
     * @param string $name
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    public function setName($name)
    {
        if (strlen($name) == 0) {
            throw new \InvalidArgumentException(
                'The name can not be blank.',
                1373527548
            );
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLegalName()
    {
        return $this->legalName;
    }

    /**
     * @param string $legalName
     *
     * @return void
     */
    public function setLegalName($legalName)
    {
        $this->legalName = $legalName;
    }

    /**
     * @return string
     */
    public function getLegalForm()
    {
        return $this->legalForm;
    }

    /**
     * @param string $legalForm
     *
     * @return void
     */
    public function setLegalForm($legalForm)
    {
        $this->legalForm = $legalForm;
    }

    /**
     * @return string
     */
    public function getRegisteredOffice()
    {
        return $this->registeredOffice;
    }

    /**
     * @param string $registeredOffice
     *
     * @return void
     */
    public function setRegisteredOffice($registeredOffice)
    {
        $this->registeredOffice = $registeredOffice;
    }

    /**
     * @return string
     */
    public function getRegisterCourt()
    {
        return $this->registerCourt;
    }

    /**
     * @param string $registerCourt
     *
     * @return void
     */
    public function setRegisterCourt($registerCourt)
    {
        $this->registerCourt = $registerCourt;
    }

    /**
     * @return string
     */
    public function getRegisterNumber()
    {
        return $this->registerNumber;
    }

    /**
     * @param string $registerNumber
     *
     * @return void
     */
    public function setRegisterNumber($registerNumber)
    {
        $this->registerNumber = $registerNumber;
    }

    /**
     * @return string
     */
    public function getVatId()
    {
        return $this->vatId;
    }

    /**
     * @param string $vatId
     *
     * @return void
     */
    public function setVatId($vatId)
    {
        $this->vatId = $vatId;
    }

    /**
     * Adds a Director
     *
     * @param \Extcode\Contacts\Domain\Model\Contact $director
     *
     * @return void
     */
    public function addDirector(\Extcode\Contacts\Domain\Model\Contact $director)
    {
        $this->directors->attach($director);
    }

    /**
     * Removes a Director
     *
     * @param \Extcode\Contacts\Domain\Model\Contact $directorToRemove
     *
     * @return void
     */
    public function removeDirector(\Extcode\Contacts\Domain\Model\Contact $directorToRemove)
    {
        $this->directors->detach($directorToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact>
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact> $directors
     *
     * @return void
     */
    public function setDirectors($directors)
    {
        $this->directors = $directors;
    }

    /**
     * Adds a Contact
     *
     * @param \Extcode\Contacts\Domain\Model\Contact $contact
     *
     * @return void
     */
    public function addContact(\Extcode\Contacts\Domain\Model\Contact $contact)
    {
        $this->contacts->attach($contact);
    }

    /**
     * Removes a Contact
     *
     * @param \Extcode\Contacts\Domain\Model\Contact $contactToRemove
     *
     * @return void
     */
    public function removeContact(\Extcode\Contacts\Domain\Model\Contact $contactToRemove)
    {
        $this->contacts->detach($contactToRemove);
    }

    /**
     * Returns the contacts
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact> $contacts
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * Sets the contacts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact> $contacts
     *
     * @return void
     */
    public function setContacts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * Adds a Address
     *
     * @param \Extcode\Contacts\Domain\Model\Address $address
     *
     * @return void
     */
    public function addAddress(\Extcode\Contacts\Domain\Model\Address $address)
    {
        $this->addresses->attach($address);
    }

    /**
     * Removes a Address
     *
     * @param \Extcode\Contacts\Domain\Model\Address $addressToRemove The Address to be removed
     *
     * @return void
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
     *
     * @return void
     */
    public function setAddresses(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Adds a Phone Number
     *
     * @param \Extcode\Contacts\Domain\Model\Phone $phoneNumber
     *
     * @return void
     */
    public function addPhoneNumber(\Extcode\Contacts\Domain\Model\Phone $phoneNumber)
    {
        $this->phoneNumbers->attach($phoneNumber);
    }

    /**
     * Removes a Phone Number
     *
     * @param \Extcode\Contacts\Domain\Model\Phone $phoneNumberToRemove The Phone Number to be removed
     *
     * @return void
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
     *
     * @return void
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
     *
     * @return void
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
     *
     * @return void
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    /**
     * Returns the logo
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Sets the logo
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $logo
     *
     * @return void
     */
    public function setLogo(\TYPO3\CMS\Extbase\Domain\Model\FileReference $logo)
    {
        $this->logo = $logo;
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
     *
     * @return void
     */
    public function setTtContent($ttContent)
    {
        $this->ttContent = $ttContent;
    }
}
