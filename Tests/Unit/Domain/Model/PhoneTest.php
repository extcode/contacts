<?php

namespace Extcode\Contacts\Tests\Domain\Model;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use Nimut\TestingFramework\TestCase\UnitTestCase;

class PhoneTest extends UnitTestCase
{
    /**
     * @var \Extcode\Contacts\Domain\Model\Phone
     */
    protected $fixture = null;

    /**
     *
     */
    public function setUp()
    {
        $this->fixture = new \Extcode\Contacts\Domain\Model\Phone();
    }

    /**
     *
     */
    public function tearDown()
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getTypeInitiallyReturnsDefaultTypes()
    {
        $this->assertSame(
            'VOICE',
            $this->fixture->getType()
        );
    }

    /**
     * @test
     */
    public function setValidTypeSetsType()
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
    public function setInvalidTypeThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The type have to be a set of (PREF, WORK, HOME, VOICE, FAX, MSG, CELL, PAGER, BBS, MODEM, CAR, ISDN, VIDEO).');
        $this->expectExceptionCode(1373531068);

        $this->fixture->setType('inValidType');
    }

    /**
     * @test
     */
    public function getNumberInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getNumber()
        );
    }

    /**
     * @test
     */
    public function setNumberSetsNumber()
    {
        $this->fixture->setNumber('foo bar');

        $this->assertSame(
            'foo bar',
            $this->fixture->getNumber()
        );
    }
}
