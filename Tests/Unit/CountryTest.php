<?php

namespace Extcode\Contacts\Tests;

class CountryTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * @var \Tx_Contacts_Domain_Model_Country
	 */
	protected $fixture = NULL;

	/**
	 *
	 */
	public function setUp() {
		$this->fixture = new \Extcode\Contacts\Domain\Model\Country($this->name);
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
	public function getIso2InitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getIso2()
		);
	}

	/**
	 * @test
	 */
	public function setIso2SetsIso2() {
		$this->fixture->setIso2('DE');

		$this->assertSame(
			'DE',
			$this->fixture->getIso2()
		);
	}

	/**
	 * @test
	 * @expectedException Tx_Extbase_Property_Exception_InvalidPropertyException
	 */
	public function setIso2WithMoreOrLessThanTwoDigitThrowsException() {
		$this->fixture->setIso2('D');
		$this->fixture->setIso2('DEU');
	}

	/**
	 * @test
	 */
	public function getIso3InitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getIso3()
		);
	}

	/**
	 * @test
	 */
	public function setIso3SetsIso3() {
		$this->fixture->setIso3('DEU');

		$this->assertSame(
			'DEU',
			$this->fixture->getIso3()
		);
	}

	/**
	 * @test
	 */
	public function setIso3WithEmptyStringSetsIso3ToEmptyString() {
		$this->fixture->setIso3('');

		$this->assertSame(
			'',
			$this->fixture->getIso3()
		);
	}

	/**
	 * @test
	 * @expectedException Tx_Extbase_Property_Exception_InvalidPropertyException
	 */
	public function setIso3WithNoEmptyStringAndMoreOrLessThanThreeDigitThrowsException() {
		$this->fixture->setIso3('DE');
		$this->fixture->setIso3('DEUT');
	}

	/**
	 * @test
	 */
	public function getNameInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameSetsName() {
		$this->fixture->setName('Name new');

		$this->assertSame(
			'Name new',
			$this->fixture->getName()
		);
	}

}