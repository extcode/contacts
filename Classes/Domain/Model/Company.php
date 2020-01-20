<?php

namespace Extcode\Contacts\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Company extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var string
     * @validate NotEmpty
     */
    protected $name;

    /**
     * @var string
     */
    protected $legalName = '';

    /**
     * @var string
     */
    protected $legalForm = '';

    /**
     * @var string
     */
    protected $registeredOffice = '';

    /**
     * @var string
     */
    protected $registerCourt = '';

    /**
     * @var string
     */
    protected $registerNumber = '';

    /**
     * @var string
     */
    protected $vatId = '';

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact>
     */
    protected $directors;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact>
     */
    protected $contacts;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Company>
     */
    protected $companies;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Address>
     */
    protected $addresses;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Phone>
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
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $logo = null;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\Category
     */
    protected $category;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\TtContent>
     * @lazy
     */
    protected $ttContent;

    /**
     * @param string $name
     */
    public function __construct(string $name)
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
     */
    public function setName(string $name)
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
     */
    public function setLegalName(string $legalName)
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
     */
    public function setLegalForm(string $legalForm)
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
     */
    public function setRegisteredOffice(string $registeredOffice)
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
     */
    public function setRegisterCourt(string $registerCourt)
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
     */
    public function setRegisterNumber(string $registerNumber)
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
     */
    public function setVatId(string $vatId)
    {
        $this->vatId = $vatId;
    }

    /**
     * @param Contact $director
     */
    public function addDirector(Contact $director)
    {
        $this->directors->attach($director);
    }

    /**
     * @param Contact $director
     */
    public function removeDirector(Contact $director)
    {
        $this->directors->detach($director);
    }

    /**
     * @return ObjectStorage<Contact>
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * @param ObjectStorage<Contact> $directors
     */
    public function setDirectors($directors)
    {
        $this->directors = $directors;
    }

    /**
     * @param Contact $contact
     */
    public function addContact(Contact $contact)
    {
        $this->contacts->attach($contact);
    }

    /**
     * @param Contact $contact
     */
    public function removeContact(Contact $contact)
    {
        $this->contacts->detach($contact);
    }

    /**
     * @return ObjectStorage<Contact> $contacts
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param ObjectStorage<Contact> $contacts
     */
    public function setContacts(ObjectStorage $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * @param Company $company
     */
    public function addCompany(self $company)
    {
        $this->companies->attach($company);
    }

    /**
     * @param Company $company
     */
    public function removeCompany(self $company)
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
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param FileReference $logo
     */
    public function setLogo(FileReference $logo)
    {
        $this->logo = $logo;
    }

    /**
     * Returns the Main Category
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Sets the Main Category
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * Adds a Product Category
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     */
    public function addCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a Category
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     */
    public function removeCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $category)
    {
        $this->categories->detach($category);
    }

    /**
     * Returns the Categories
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Returns the First Category
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\Category
     */
    public function getFirstCategory()
    {
        $categories = $this->getCategories();
        if ($categories !== null) {
            $categories->rewind();
            return $categories->current();
        }

        return null;
    }

    /**
     * Sets the Categories
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $categories
     */
    public function setCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $categories)
    {
        $this->categories = $categories;
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
