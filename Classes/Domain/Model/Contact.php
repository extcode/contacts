<?php

namespace Extcode\Contacts\Domain\Model;

/**
 * Class Contact
 * @package Extcode\Contacts\Domain\Model
 */
class Contact extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * @var integer
	 */
	protected $birthday = 0;

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
	 * @param $salutation
	 * @param $title
	 * @param $firstName
	 * @param $lastName
	 */
	public function __construct($salutation, $title, $firstName, $lastName) {
		$this->salutation = $salutation;
		$this->title = $title;
		$this->firstName = $firstName;
		$this->lastName = $lastName;

		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->addresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->phoneNumbers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}


	/**
	 * @param string $salutation
	 */
	public function setSalutation($salutation) {
		$this->salutation = $salutation;
	}

	/**
	 * @return string
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * @param string $title
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $firstName
	 * @throws \InvalidArgumentException
	 */
	public function setFirstName($firstName) {
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
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * @param string $lastName
	 * @throws \InvalidArgumentException
	 */
	public function setLastName($lastName) {
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
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * @param int $birthday
	 */
	public function setBirthday($birthday) {
		$this->birthday = $birthday;
	}

	/**
	 * @return int
	 */
	public function getBirthday() {
		return $this->birthday;
	}

	/**
	 * Adds a Address
	 *
	 * @param \Extcode\Contacts\Domain\Model\Address $address
	 * @return void
	 */
	public function addAddress(\Extcode\Contacts\Domain\Model\Address $address) {
		$this->addresses->attach($address);
	}

	/**
	 * Removes a Address
	 *
	 * @param \Extcode\Contacts\Domain\Model\Address $addressToRemove The Address to be removed
	 * @return void
	 */
	public function removeAddress(\Extcode\Contacts\Domain\Model\Address $addressToRemove) {
		$this->addresses->detach($addressToRemove);
	}

	/**
	 * Returns the addresses
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Address> $addresses
	 */
	public function getAddresses() {
		return $this->addresses;
	}

	/**
	 * Sets the addresses
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Address> $addresses
	 * @return void
	 */
	public function setAddresses(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $addresses) {
		$this->addresses = $addresses;
	}

	/**
	 * Adds a Phone Number
	 *
	 * @param \Extcode\Contacts\Domain\Model\Phone $phoneNumber
	 * @return void
	 */
	public function addPhoneNumber(\Extcode\Contacts\Domain\Model\Phone $phoneNumber) {
		$this->phoneNumbers->attach($phoneNumber);
	}

	/**
	 * Removes a Phone Number
	 *
	 * @param \Extcode\Contacts\Domain\Model\Phone $phoneNumberToRemove The Phone Number to be removed
	 * @return void
	 */
	public function removePhoneNumber(\Extcode\Contacts\Domain\Model\Phone $phoneNumberToRemove) {
		$this->phoneNumbers->detach($phoneNumberToRemove);
	}

	/**
	 * Returns the phoneNumbers
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Phone> $phoneNumbers
	 */
	public function getPhoneNumbers() {
		return $this->phoneNumbers;
	}

	/**
	 * Sets the phoneNumbers
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Phone> $phoneNumbers
	 * @return void
	 */
	public function setPhoneNumbers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $phoneNumbers) {
		$this->phoneNumbers = $phoneNumbers;
	}

}