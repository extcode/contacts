<?php

namespace Extcode\Contacts\Tests;

class ContactTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Tx_Contacts_Domain_Model_Contact
	 */
	protected $fixture = NULL;

	/**
	 *
	 */
	public function setUp() {
		$this->fixture = new \Extcode\Contacts\Domain\Model\Contact('Firstname', 'Lastname');
	}

	/**
	 *
	 */
	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getFirstNameInitiallyReturnsFirstName() {
		$this->assertSame(
			'Firstname',
			$this->fixture->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameSetsFirstName() {
		$this->fixture->setFirstName('Firstname new');

		$this->assertSame(
			'Firstname new',
			$this->fixture->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameWithEmptyStringThrowsException() {
		$this->setExpectedException(
			'InvalidArgumentException',
			'The first name can not be blank.',
			1373525114
		);

		$this->fixture->setFirstName('');
	}

	/**
	 * @test
	 */
	public function getLastNameInitiallyReturnsLastName() {
		$this->assertSame(
			'Lastname',
			$this->fixture->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameSetsLastName() {
		$this->fixture->setLastName('Lastname new');

		$this->assertSame(
			'Lastname new',
			$this->fixture->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameWithEmptyStringThrowsException() {
		$this->setExpectedException(
			'InvalidArgumentException',
			'The last name can not be blank.',
			1373525586
		);

		$this->fixture->setLastName('');
	}


}