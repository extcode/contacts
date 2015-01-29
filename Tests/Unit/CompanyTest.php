<?php

namespace Extcode\Contacts\Tests;

class CompanyTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * Name
	 *
	 * @var string
	 */
	protected $name;

	/**
	 * @var \Tx_Contacts_Domain_Model_Company
	 */
	protected $fixture = NULL;

	/**
	 *
	 */
	public function setUp() {
		$this->name = "Name";

		$this->fixture = new \Extcode\Contacts\Domain\Model\Company($this->name);
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
	public function getNameInitiallyReturnsName() {
		$this->assertSame(
			$this->name,
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

	/**
	 * @test
	 */
	public function setNameWithEmptyStringThrowsException() {
		$this->setExpectedException(
			'InvalidArgumentException',
			'The name can not be blank.',
			1373527548
		);

		$this->fixture->setName('');
	}

}