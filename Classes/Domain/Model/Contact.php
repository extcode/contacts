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

class Contact extends AbstractContact
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
     * @var \DateTime
     */
    protected $birthday;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Company>
     */
    protected $companies;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $photo;

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
    public function getFullName(string $seperator)
    {
        return implode($seperator, [$this->getFirstName(), $this->getLastName()]);
    }

    /**
     * @param string $seperator
     * @return string
     */
    public function getTitleFullName(string $seperator)
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
}
