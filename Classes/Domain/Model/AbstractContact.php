<?php
declare(strict_types=1);

namespace Extcode\Contacts\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\Category;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

abstract class AbstractContact extends AbstractEntity
{
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
     * @var string
     */
    protected $teaser = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var string
     */
    protected $metaDescription = '';

    /**
     * @TYPO3\CMS\Extbase\Annotation\ORM\Lazy
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\TtContent>
     */
    protected $ttContent;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\Category
     */
    protected $category;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
     */
    protected $categories;

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
     * @return ObjectStorage<Address>
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
    public function getEmail(): string
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
    public function getUri(): string
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
     * @return string
     */
    public function getTeaser(): string
    {
        return $this->teaser;
    }

    /**
     * @param string $teaser
     */
    public function setTeaser(string $teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription(string $metaDescription)
    {
        $this->metaDescription = $metaDescription;
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
    public function addCategory(Category $category)
    {
        $this->categories->attach($category);
    }

    /**
     * Removes a Category
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\Category $category
     */
    public function removeCategory(Category $category)
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
    public function setCategories(ObjectStorage $categories)
    {
        $this->categories = $categories;
    }
}
