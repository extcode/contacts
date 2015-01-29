<?php

namespace Extcode\Contacts\Tests;

class AddressTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {
	/**
	 * @var \Tx_Contacts_Domain_Model_Address
	 */
	protected $fixture = NULL;

	/**
	 *
	 */
	public function setUp() {
		$this->fixture = new \Extcode\Contacts\Domain\Model\Address();
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
			'INTL,POSTAL,PARCEL,WORK',
			$this->fixture->getType()
		);
	}

	/**
	 * @test
	 */
	public function setValidTypeSetsType() {
		$this->fixture->setType('DOM');

		$this->assertSame(
			'DOM',
			$this->fixture->getType()
		);
	}

	/**
	 * @test
	 */
	public function setInvalidTypeThrowsException() {
		$this->setExpectedException(
			'InvalidArgumentException',
			'The type have to be a set of (DOM, INTL, POSTAL, PARCEL, HOME, WORK).',
			1373530255
		);

		$this->fixture->setType('inValidType');
	}
	
	/**
	 * @test
	 */
	public function getStreetInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getStreet()
		);
	}

	/**
	 * @test
	 */
	public function setStreetSetsStreet() {
		$this->fixture->setStreet('Street');

		$this->assertSame(
			'Street',
			$this->fixture->getStreet()
		);
	}
	
	/**
	 * @test
	 */
	public function getStreetNumberInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getStreetNumber()
		);
	}
	
	/**
	 * @test
	 */
	public function setStreetNumberSetsStreetNumber() {
		$this->fixture->setStreetNumber('Street Number');
	
		$this->assertSame(
			'Street Number',
			$this->fixture->getStreetNumber()
		);
	}
	
	/**
	 * @test
	 */
	public function getZipInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getZip()
		);
	}
	
	/**
	 * @test
	 */
	public function setZipSetsZip() {
		$this->fixture->setZip('ZIP');
	
		$this->assertSame(
			'ZIP',
			$this->fixture->getZip()
		);
	}
	
	/**
	 * @test
	 */
	public function getCityInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getCity()
		);
	}
	
	/**
	 * @test
	 */
	public function setCitySetsCity() {
		$this->fixture->setCity('City');
	
		$this->assertSame(
			'City',
			$this->fixture->getCity()
		);
	}

	/**
	 * @test
	 */
	public function getRegionInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getRegion()
		);
	}

	/**
	 * @test
	 */
	public function setRegionSetsRegion() {
		$this->fixture->setRegion('Region');

		$this->assertSame(
			'Region',
			$this->fixture->getRegion()
		);
	}
	
	/**
	 * @test
	 */
	public function getCountryInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getCountry()
		);
	}
	
	/**
	 * @test
	 */
	public function setCountrySetsCountry() {
		$this->fixture->setCountry('Country');
	
		$this->assertSame(
			'Country',
			$this->fixture->getCountry()
		);
	}
	
	/**
	 * @test
	 */
	public function getPostBoxInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getPostBox()
		);
	}
	
	/**
	 * @test
	 */
	public function setPostBoxSetsPostBox() {
		$this->fixture->setPostBox('Post Box');
	
		$this->assertSame(
			'Post Box',
			$this->fixture->getPostBox()
		);
	}

	/**
	 * @test
	 */
	public function getLatInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getLat()
		);
	}

	/**
	 * @test
	 */
	public function setLatSetsLat() {
		$this->fixture->setLat('52° 31′ N');

		$this->assertSame(
			'52° 31′ N',
			$this->fixture->getLat()
		);
	}

	/**
	 * @test
	 */
	public function getLonInitiallyReturnsEmptyString() {
		$this->assertSame(
			'',
			$this->fixture->getLon()
		);
	}

	/**
	 * @test
	 */
	public function setLonSetsLon() {
		$this->fixture->setLon('13° 24′ O');

		$this->assertSame(
			'13° 24′ O',
			$this->fixture->getLon()
		);
	}
}