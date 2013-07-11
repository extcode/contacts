<?php

namespace Extcode\Contacts\Domain\Model;

class Contact extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {#

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
	 * @param $firstName
	 * @param $lastName
	 */
	public function __construct($firstName, $lastName) {
		$this->firstName = $firstName;
		$this->lastName = $lastName;
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