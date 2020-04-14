<?php

namespace Extcode\Contacts\Tests\Domain\Model;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Contact;
use InvalidArgumentException;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class ContactTest extends UnitTestCase
{
    /**
     * @var string
     */
    protected $salutation;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var Contact
     */
    protected $fixture;

    /**
     *
     */
    public function setUp(): void
    {
        $this->salutation = 'Salutation';
        $this->title = 'Title';
        $this->firstName = 'FirstName';
        $this->lastName = 'LastName';
        $this->fixture = new Contact(
            $this->salutation,
            $this->title,
            $this->firstName,
            $this->lastName
        );
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
    public function getSalutationInitiallyReturnsSalutation(): void
    {
        $this->assertSame(
            $this->salutation,
            $this->fixture->getSalutation()
        );
    }

    /**
     * @test
     */
    public function setSalutationSetsSalutation(): void
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
    public function getTitleInitiallyReturnsTitle(): void
    {
        $this->assertSame(
            $this->title,
            $this->fixture->getTitle()
        );
    }

    /**
     * @test
     */
    public function setTitleSetsTitle(): void
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
    public function getFirstNameInitiallyReturnsFirstName(): void
    {
        $this->assertSame(
            $this->firstName,
            $this->fixture->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameSetsFirstName(): void
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
    public function setFirstNameWithEmptyStringThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The first name can not be blank.');
        $this->expectExceptionCode(1373525114);

        $this->fixture->setFirstName('');
    }

    /**
     * @test
     */
    public function getLastNameInitiallyReturnsLastName(): void
    {
        $this->assertSame(
            $this->lastName,
            $this->fixture->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameSetsLastName(): void
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
    public function setLastNameWithEmptyStringThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The last name can not be blank.');
        $this->expectExceptionCode(1373525586);

        $this->fixture->setLastName('');
    }

    /**
     * @test
     */
    public function getBirthdayInitiallyReturnsZero(): void
    {
        $this->assertNull(
            $this->fixture->getBirthday()
        );
    }

    /**
     * @test
     */
    public function setBirthdaySetsBirthday(): void
    {
        $birthdate = new \DateTime('2019-05-05');

        $this->fixture->setBirthday($birthdate);

        $this->assertSame(
            $birthdate,
            $this->fixture->getBirthday()
        );
    }

    /**
     * @test
     */
    public function getTeaserInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getTeaser()
        );
    }

    /**
     * @test
     */
    public function setTeaserSetsTeaser(): void
    {
        $this->fixture->setTeaser('Teaser');

        $this->assertSame(
            'Teaser',
            $this->fixture->getTeaser()
        );
    }

    /**
     * @test
     */
    public function getDescriptionInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getDescription()
        );
    }

    /**
     * @test
     */
    public function setDescriptionSetsDescription(): void
    {
        $this->fixture->setDescription('Description');

        $this->assertSame(
            'Description',
            $this->fixture->getDescription()
        );
    }

    /**
     * @test
     */
    public function getMetaDescriptionInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getMetaDescription()
        );
    }

    /**
     * @test
     */
    public function setMetaDescriptionSetsMetaDescription(): void
    {
        $this->fixture->setMetaDescription('MetaDescription');

        $this->assertSame(
            'MetaDescription',
            $this->fixture->getMetaDescription()
        );
    }
}
