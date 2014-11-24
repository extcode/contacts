<?php

namespace Extcode\Contacts\Domain\Model;

/**
 * Class Company
 * @package Extcode\Contacts\Domain\Model
 */
class Company extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Name
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $name;

	/**
	 * contacts
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
	 * @param $name
	 */
	public function __construct($name) {
		$this->name = $name;

		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->contacts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->addresses = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->phoneNumbers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @throws \InvalidArgumentException
	 */
	public function setName($name) {
		if (strlen($name) == 0) {
			throw new \InvalidArgumentException(
				'The name can not be blank.',
				1373527548
			);
		}

		$this->name = $name;
	}

	/**
	 * Adds a Contact
	 *
	 * @param \Extcode\Contacts\Domain\Model\Contact $contact
	 * @return void
	 */
	public function addContact(\Extcode\Contacts\Domain\Model\Contact $contact) {
		$this->contacts->attach($contact);
	}

	/**
	 * Removes a Contact
	 *
	 * @param \Extcode\Contacts\Domain\Model\Contact $contactToRemove The Contact to be removed
	 * @return void
	 */
	public function removeContact(\Extcode\Contacts\Domain\Model\Contact $contactToRemove) {
		$this->contacts->detach($contactToRemove);
	}

	/**
	 * Returns the contacts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact> $contacts
	 */
	public function getContacts() {
		return $this->contacts;
	}

	/**
	 * Sets the contacts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\Contacts\Domain\Model\Contact> $contacts
	 * @return void
	 */
	public function setContacts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $contacts) {
		$this->contacts = $contacts;
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