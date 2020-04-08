<?php

namespace Extcode\Contacts\Domain\Model;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

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
     * @validate NotEmpty
     */
    protected $firstName;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $lastName;

    /**
     * @var \DateTime
     */
    protected $birthday;

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
    protected $photo;

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
     * @param \DateTime $birthday
     */
    public function setBirthday(\DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return \DateTime|null
     */
    public function getBirthday()
    {
        if ($this->birthday) {
            return $this->birthday;
        }

        return null;
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
