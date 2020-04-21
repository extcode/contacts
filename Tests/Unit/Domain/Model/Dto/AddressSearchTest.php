<?php

namespace Extcode\Contacts\Tests\Unit\Domain\Model\Dto;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Dto\AddressSearch;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class AddressSearchTest extends UnitTestCase
{
    /**
     * @var AddressSearch
     */
    protected $fixture;

    /**
     *
     */
    public function setUp(): void
    {
        $this->fixture = new AddressSearch();
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
    public function getLatInitiallyReturnsZeroFloat(): void
    {
        $this->assertSame(
            0.0,
            $this->fixture->getLat()
        );
    }

    /**
     * @test
     */
    public function setLatSetsLat(): void
    {
        $lat = 54.6717825;

        $this->fixture->setLat($lat);

        $this->assertSame(
            $lat,
            $this->fixture->getLat()
        );
    }

    /**
     * @test
     */
    public function getLonInitiallyReturnsZeroFloat(): void
    {
        $this->assertSame(
            0.0,
            $this->fixture->getLon()
        );
    }

    /**
     * @test
     */
    public function setLonSetsLon(): void
    {
        $lon = 13.4308058;

        $this->fixture->setLon($lon);

        $this->assertSame(
            $lon,
            $this->fixture->getLon()
        );
    }

    /**
     * @test
     */
    public function getRadiusInitiallyReturnsZeroInt(): void
    {
        $this->assertSame(
            0,
            $this->fixture->getRadius()
        );
    }

    /**
     * @test
     */
    public function setRadiusSetsRadius(): void
    {
        $radius = 10;

        $this->fixture->setRadius($radius);

        $this->assertSame(
            $radius,
            $this->fixture->getRadius()
        );
    }

    /**
     * @test
     */
    public function getPidsInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getPids()
        );
    }

    /**
     * @test
     */
    public function setPidsSetsPids(): void
    {
        $pids = '10, 30';

        $this->fixture->setPids($pids);

        $this->assertSame(
            $pids,
            $this->fixture->getPids()
        );
    }

    /**
     * @test
     */
    public function getSearchStringInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getSearchString()
        );
    }

    /**
     * @test
     */
    public function setSearchStringSetsSearchString(): void
    {
        $searchString = '10, 30';

        $this->fixture->setSearchString($searchString);

        $this->assertSame(
            $searchString,
            $this->fixture->getSearchString()
        );
    }

    /**
     * @test
     */
    public function getOrderByInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getOrderBy()
        );
    }

    /**
     * @test
     */
    public function setOrderBySetsOrderBy(): void
    {
        $orderBy = 'distance';

        $this->fixture->setOrderBy($orderBy);

        $this->assertSame(
            $orderBy,
            $this->fixture->getOrderBy()
        );
    }

    /**
     * @test
     */
    public function getFallbackOrderByInitiallyReturnsEmptyString(): void
    {
        $this->assertEmpty(
            $this->fixture->getFallbackOrderBy()
        );
    }

    /**
     * @test
     */
    public function setFallbackOrderBySetsFallbackOrderBy(): void
    {
        $fallbackOrderBy = 'title';

        $this->fixture->setFallbackOrderBy($fallbackOrderBy);

        $this->assertSame(
            $fallbackOrderBy,
            $this->fixture->getFallbackOrderBy()
        );
    }
}
