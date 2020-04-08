<?php

namespace Extcode\Contacts\Tests\Domain\Model;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Address;
use Extcode\Contacts\Domain\Model\Country;
use InvalidArgumentException;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class AddressTest extends UnitTestCase
{
    /**
     * @var Address
     */
    protected $fixture;

    /**
     *
     */
    public function setUp(): void
    {
        $this->fixture = new Address();
    }

    /**
     *
     */
    public function tearDown(): void
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getTypeInitiallyReturnsDefaultTypes(): void
    {
        $this->assertSame(
            'INTL,POSTAL,PARCEL,WORK',
            $this->fixture->getType()
        );
    }

    /**
     * @test
     */
    public function setValidTypeSetsType(): void
    {
        $this->fixture->setType('DOM');

        $this->assertSame(
            'DOM',
            $this->fixture->getType()
        );
    }

    /**
     * @test
     */
    public function setInvalidTypeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The type have to be a set of (DOM, INTL, POSTAL, PARCEL, HOME, WORK).');
        $this->expectExceptionCode(1373530255);

        $this->fixture->setType('inValidType');
    }

    /**
     * @test
     */
    public function getStreetInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getStreet()
        );
    }

    /**
     * @test
     */
    public function setStreetSetsStreet(): void
    {
        $this->fixture->setStreet('Street');

        $this->assertSame(
            'Street',
            $this->fixture->getStreet()
        );
    }

    /**
     * @test
     */
    public function getStreetNumberInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getStreetNumber()
        );
    }

    /**
     * @test
     */
    public function setStreetNumberSetsStreetNumber(): void
    {
        $this->fixture->setStreetNumber('Street Number');

        $this->assertSame(
            'Street Number',
            $this->fixture->getStreetNumber()
        );
    }

    /**
     * @test
     */
    public function getAddition1InitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getAddition1()
        );
    }

    /**
     * @test
     */
    public function setAddition1SetsAddition1(): void
    {
        $this->fixture->setAddition1('Addition1');

        $this->assertSame(
            'Addition1',
            $this->fixture->getAddition1()
        );
    }

    /**
     * @test
     */
    public function getAddition2InitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getAddition2()
        );
    }

    /**
     * @test
     */
    public function setAddition1SetsAddition2(): void
    {
        $this->fixture->setAddition2('Addition2');

        $this->assertSame(
            'Addition2',
            $this->fixture->getAddition2()
        );
    }

    /**
     * @test
     */
    public function getZipInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getZip()
        );
    }

    /**
     * @test
     */
    public function setZipSetsZip(): void
    {
        $this->fixture->setZip('ZIP');

        $this->assertSame(
            'ZIP',
            $this->fixture->getZip()
        );
    }

    /**
     * @test
     */
    public function getCityInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getCity()
        );
    }

    /**
     * @test
     */
    public function setCitySetsCity(): void
    {
        $this->fixture->setCity('City');

        $this->assertSame(
            'City',
            $this->fixture->getCity()
        );
    }

    /**
     * @test
     */
    public function getRegionInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getRegion()
        );
    }

    /**
     * @test
     */
    public function setRegionSetsRegion(): void
    {
        $this->fixture->setRegion('Region');

        $this->assertSame(
            'Region',
            $this->fixture->getRegion()
        );
    }

    /**
     * @test
     */
    public function getCountryInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getCountry()
        );
    }

    /**
     * @test
     */
    public function setCountrySetsCountry(): void
    {
        $country = new Country();
        $country->setIso2('de');

        $this->fixture->setCountry($country);

        $this->assertSame(
            $country,
            $this->fixture->getCountry()
        );
    }

    /**
     * @test
     */
    public function getPostBoxInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getPostBox()
        );
    }

    /**
     * @test
     */
    public function setPostBoxSetsPostBox(): void
    {
        $this->fixture->setPostBox('Post Box');

        $this->assertSame(
            'Post Box',
            $this->fixture->getPostBox()
        );
    }

    /**
     * @test
     */
    public function getLatInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getLat()
        );
    }

    /**
     * @test
     */
    public function setLatSetsLat(): void
    {
        $this->fixture->setLat('52° 31′ N');

        $this->assertSame(
            '52° 31′ N',
            $this->fixture->getLat()
        );
    }

    /**
     * @test
     */
    public function getLonInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getLon()
        );
    }

    /**
     * @test
     */
    public function setLonSetsLon(): void
    {
        $this->fixture->setLon('13° 24′ O');

        $this->assertSame(
            '13° 24′ O',
            $this->fixture->getLon()
        );
    }
}
