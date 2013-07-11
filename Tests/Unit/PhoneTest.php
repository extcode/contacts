<?php

namespace Extcode\Contacts\Tests;

class PhoneTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Tx_Contacts_Domain_Model_Phone
	 */
	protected $fixture = NULL;

	/**
	 *
	 */
	public function setUp() {
		$this->fixture = new \Extcode\Contacts\Domain\Model\Phone();
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
	public function getTypeInitiallyReturnsDefaultTypes() {
		$this->assertSame(
			'VOICE',
			$this->fixture->getType()
		);
	}

	/**
	 * @test
	 */
	public function setValidTypeSetsType() {
		$this->fixture->setType('CELL');

		$this->assertSame(
			'CELL',
			$this->fixture->getType()
		);
	}

	/**
	 * @test
	 */
	public function setInvalidTypeThrowsException() {
		$this->setExpectedException(
			'InvalidArgumentException',
			'The type have to be a set of (PREF, WORK, HOME, VOICE, FAX, MSG, CELL, PAGER, BBS, MODEM, CAR, ISDN, VIDEO).',
			1373531068
		);

		$this->fixture->setType('inValidType');
	}
	
	/**
	 * @test
	 */
	public function getNumberInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getNumber()
		);
	}
	
	/**
	 * @test
	 */
	public function setNumberSetsNumber() {
		$this->fixture->setNumber('foo bar');
	
		$this->assertSame(
			'foo bar',
			$this->fixture->getNumber()
		);
	}
}