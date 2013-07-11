<?php

namespace Extcode\Contacts\Domain\Model;

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
}