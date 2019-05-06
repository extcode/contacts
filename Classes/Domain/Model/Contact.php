<?php

namespace Extcode\Contacts\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Contact extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     */
    protected $salutation = '';

    /**
     * @var string
     */
    protected $title = '';

    /**
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $firstName;

    /**
     * @var string
     * @TYPO3\CMS\Extbase\Annotation\Validate("NotEmpty")
     */
    protected $lastName;

    /**
     * @var int
     */
    protected $birthday = 0;

    /**
     * @var ObjectStorage<Company>
     */
    protected $companies;

    /**
     * @var ObjectStorage<Address>
     */
    protected $addresses;

    /**
     * @var ObjectStorage<Phone>
     */
    protected $phoneNumbers;

    /**
     * @var string
     */
    protected $email = '';

    /**
     * @var string
     */
    protected $uri = '';

    /**
     * @var FileReference
     */
    protected $photo = null;

    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var ObjectStorage<\Extcode\Contacts\Domain\Model\TtContent>
     */
    protected $ttContent;

    /**
     * @param string $salutation
     * @param string $title
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct(string $salutation, string $title, string $firstName, string $lastName)
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
        $this->companies = new ObjectStorage();
        $this->addresses = new ObjectStorage();
        $this->phoneNumbers = new ObjectStorage();
    }

    /**
     * @param string $salutation
     */
    public function setSalutation(string $salutation)
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
     * @param string $firstName
     *
     * @throws \InvalidArgumentException
     */
    public function setFirstName(string $firstName)
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
    public function setLastName(string $lastName)
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
    public function getFullName(string $seperator = ' ')
    {
        return implode($seperator, [$this->getFirstName(), $this->getLastName()]);
    }

    /**
     * @param string $seperator
     * @return string
     */
    public function getTitleFullName(string $seperator = ' ')
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
    public function setBirthday(int $birthday)
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
     * @param Company $company
     */
    public function addCompany(Company $company)
    {
        $this->companies->attach($company);
    }

    /**
     * @param Company $company
     */
    public function removeCompany(Company $company)
    {
        $this->companies->detach($company);
    }

    /**
     * @return ObjectStorage<Company> $companies
     */
    public function getCompanies()
    {
        return $this->companies;
    }

    /**
     * @param ObjectStorage<Company> $companies
     */
    public function setCompanies(ObjectStorage $companies)
    {
        $this->companies = $companies;
    }

    /**
     * @param Address $address
     */
    public function addAddress(Address $address)
    {
        $this->addresses->attach($address);
    }

    /**
     * @param Address $address
     */
    public function removeAddress(Address $address)
    {
        $this->addresses->detach($address);
    }

    /**
     * @return ObjectStorage<Address> $addresses
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * @param ObjectStorage<Address> $addresses
     */
    public function setAddresses(ObjectStorage $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @param Phone $phoneNumber
     */
    public function addPhoneNumber(Phone $phoneNumber)
    {
        $this->phoneNumbers->attach($phoneNumber);
    }

    /**
     * @param Phone $phoneNumber
     */
    public function removePhoneNumber(Phone $phoneNumber)
    {
        $this->phoneNumbers->detach($phoneNumber);
    }

    /**
     * @return ObjectStorage<Phone> $phoneNumbers
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers;
    }

    /**
     * @param ObjectStorage<Phone> $phoneNumbers
     */
    public function setPhoneNumbers(ObjectStorage $phoneNumbers)
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
    public function setEmail(string $email)
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
    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    /**
     * @return FileReference
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param FileReference $photo
     */
    public function setPhoto(FileReference $photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return ObjectStorage
     */
    public function getTtContent()
    {
        return $this->ttContent;
    }

    /**
     * @param ObjectStorage $ttContent
     */
    public function setTtContent(ObjectStorage $ttContent)
    {
        $this->ttContent = $ttContent;
    }
}
