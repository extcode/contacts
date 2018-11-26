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

class CountryTest extends UnitTestCase
{
    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * @var \Extcode\Contacts\Domain\Model\Country
     */
    protected $fixture = null;

    /**
     *
     */
    public function setUp()
    {
        $this->fixture = new \Extcode\Contacts\Domain\Model\Country($this->name);
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
    public function getIso2InitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getIso2()
        );
    }

    /**
     * @test
     */
    public function setIso2SetsIso2()
    {
        $this->fixture->setIso2('DE');

        $this->assertSame(
            'DE',
            $this->fixture->getIso2()
        );
    }

    /**
     * @test
     * @expectedException \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException
     */
    public function setIso2WithLessThanTwoDigitThrowsException()
    {
        $this->fixture->setIso2('DEU');
    }

    /**
     * @test
     * @expectedException \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException
     */
    public function setIso2WithMoreThanTwoDigitThrowsException()
    {
        $this->fixture->setIso2('DEU');
    }

    /**
     * @test
     */
    public function getIso3InitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getIso3()
        );
    }

    /**
     * @test
     */
    public function setIso3SetsIso3()
    {
        $this->fixture->setIso3('DEU');

        $this->assertSame(
            'DEU',
            $this->fixture->getIso3()
        );
    }

    /**
     * @test
     */
    public function setIso3WithEmptyStringSetsIso3ToEmptyString()
    {
        $this->fixture->setIso3('');

        $this->assertSame(
            '',
            $this->fixture->getIso3()
        );
    }

    /**
     * @test
     * @expectedException \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException
     */
    public function setIso3WithNoEmptyStringAndLessThanThreeDigitThrowsException()
    {
        $this->fixture->setIso3('DE');
    }

    /**
     * @test
     * @expectedException \TYPO3\CMS\Extbase\Property\Exception\InvalidPropertyException
     */
    public function setIso3WithNoEmptyStringAndMoreThanThreeDigitThrowsException()
    {
        $this->fixture->setIso3('DEUT');
    }

    /**
     * @test
     */
    public function getNameInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getName()
        );
    }

    /**
     * @test
     */
    public function setNameSetsName()
    {
        $this->fixture->setName('Name new');

        $this->assertSame(
            'Name new',
            $this->fixture->getName()
        );
    }
}
