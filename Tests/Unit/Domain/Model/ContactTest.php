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

/**
 * Contact Model Test
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class ContactTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * Salutation
     *
     * @var string
     */
    protected $salutation;

    /**
     * Title
     *
     * @var string
     */
    protected $title;

    /**
     * First Name
     *
     * @var string
     */
    protected $firstName;
    /**
     * Last Name
     *
     * @var string
     */
    protected $lastName;

    /**
     * @var \Extcode\Contacts\Domain\Model\Contact
     */
    protected $fixture = null;

    /**
     *
     */
    public function setUp()
    {
        $this->salutation = 'Salutation';
        $this->title = 'Title';
        $this->firstName = 'FirstName';
        $this->lastName = 'LastName';
        $this->fixture = new \Extcode\Contacts\Domain\Model\Contact($this->salutation, $this->title, $this->firstName,
            $this->lastName);
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
    public function getSalutationInitiallyReturnsSalutation()
    {
        $this->assertSame(
            $this->salutation,
            $this->fixture->getSalutation()
        );
    }

    /**
     * @test
     */
    public function setSalutationSetsSalutation()
    {
        $this->fixture->setSalutation('Salutation new');

        $this->assertSame(
            'Salutation new',
            $this->fixture->getSalutation()
        );
    }

    /**
     * @test
     */
    public function getTitleInitiallyReturnsTitle()
    {
        $this->assertSame(
            $this->title,
            $this->fixture->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle()
    {
        $this->fixture->setTitle('Title new');

        $this->assertSame(
            'Title new',
            $this->fixture->getTitle()
        );
    }

    /**
     * @test
     */
    public function getFirstNameInitiallyReturnsFirstName()
    {
        $this->assertSame(
            $this->firstName,
            $this->fixture->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameSetsFirstName()
    {
        $this->fixture->setFirstName('Firstname new');

        $this->assertSame(
            'Firstname new',
            $this->fixture->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameWithEmptyStringThrowsException()
    {
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
    public function getLastNameInitiallyReturnsLastName()
    {
        $this->assertSame(
            $this->lastName,
            $this->fixture->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameSetsLastName()
    {
        $this->fixture->setLastName('Lastname new');

        $this->assertSame(
            'Lastname new',
            $this->fixture->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameWithEmptyStringThrowsException()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            'The last name can not be blank.',
            1373525586
        );

        $this->fixture->setLastName('');
    }

    /**
     * @test
     */
    public function getBirthdayInitiallyReturnsZero()
    {
        $this->assertSame(
            0,
            $this->fixture->getBirthday()
        );
    }

    /**
     * @test
     */
    public function setBirthdaySetsBirthday()
    {
        $this->fixture->setBirthday(123456);

        $this->assertSame(
            123456,
            $this->fixture->getBirthday()
        );
    }
}
