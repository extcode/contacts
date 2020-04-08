<?php

namespace Extcode\Contacts\Tests\Domain\Model;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Phone;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class PhoneTest extends UnitTestCase
{
    /**
     * @var Phone
     */
    protected $fixture;

    /**
     *
     */
    public function setUp(): void
    {
        $this->fixture = new Phone();
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
            'VOICE',
            $this->fixture->getType()
        );
    }

    /**
     * @test
     */
    public function setValidTypeSetsType(): void
    {
        $this->fixture->setType('CELL');

        $this->assertSame(
            'CELL',
            $this->fixture->getType()
        );
    }

    /**
     * @test
     */
    public function setInvalidTypeThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The type have to be a set of (PREF, WORK, HOME, VOICE, FAX, MSG, CELL, PAGER, BBS, MODEM, CAR, ISDN, VIDEO).');
        $this->expectExceptionCode(1373531068);

        $this->fixture->setType('inValidType');
    }

    /**
     * @test
     */
    public function getNumberInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getNumber()
        );
    }

    /**
     * @test
     */
    public function setNumberSetsNumber(): void
    {
        $this->fixture->setNumber('foo bar');

        $this->assertSame(
            'foo bar',
            $this->fixture->getNumber()
        );
    }
}
