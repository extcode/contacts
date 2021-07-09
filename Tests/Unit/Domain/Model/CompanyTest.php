<?php

namespace Extcode\Contacts\Tests\Unit\Domain\Model;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Company;
use InvalidArgumentException;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

class CompanyTest extends UnitTestCase
{
    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * @var Company
     */
    protected $fixture;

    public function setUp(): void
    {
        $this->name = 'Name';

        $this->fixture = new Company($this->name);
    }

    public function tearDown(): void
    {
        unset($this->fixture);
    }

    /**
     * @test
     */
    public function getNameInitiallyReturnsName(): void
    {
        $this->assertSame(
            $this->name,
            $this->fixture->getName()
        );
    }

    /**
     * @test
     */
    public function setNameSetsName(): void
    {
        $this->fixture->setName('Name new');

        $this->assertSame(
            'Name new',
            $this->fixture->getName()
        );
    }

    /**
     * @test
     */
    public function setNameWithEmptyStringThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The name can not be blank.');
        $this->expectExceptionCode(1373527548);

        $this->fixture->setName('');
    }

    /**
     * @test
     */
    public function getLegalNameInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getLegalName()
        );
    }

    /**
     * @test
     */
    public function setLegalNameSetsLegalName(): void
    {
        $this->fixture->setLegalName('LegalName');

        $this->assertSame(
            'LegalName',
            $this->fixture->getLegalName()
        );
    }

    /**
     * @test
     */
    public function getLegalFormInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getLegalForm()
        );
    }

    /**
     * @test
     */
    public function setLegalFormSetsLegalForm(): void
    {
        $this->fixture->setLegalForm('LegalForm');

        $this->assertSame(
            'LegalForm',
            $this->fixture->getLegalForm()
        );
    }

    /**
     * @test
     */
    public function getRegisteredOfficeInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getRegisteredOffice()
        );
    }

    /**
     * @test
     */
    public function setRegisteredOfficeSetsRegisteredOffice(): void
    {
        $this->fixture->setRegisteredOffice('RegisteredOffice');

        $this->assertSame(
            'RegisteredOffice',
            $this->fixture->getRegisteredOffice()
        );
    }

    /**
     * @test
     */
    public function getRegisterCourtInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getRegisterCourt()
        );
    }

    /**
     * @test
     */
    public function setRegisterCourtSetsRegisterCourt(): void
    {
        $this->fixture->setRegisterCourt('RegisterCourt');

        $this->assertSame(
            'RegisterCourt',
            $this->fixture->getRegisterCourt()
        );
    }

    /**
     * @test
     */
    public function getRegisterNumberInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getRegisterNumber()
        );
    }

    /**
     * @test
     */
    public function setRegisterNumberSetsRegisterNumber(): void
    {
        $this->fixture->setRegisterNumber('RegisterNumber');

        $this->assertSame(
            'RegisterNumber',
            $this->fixture->getRegisterNumber()
        );
    }

    /**
     * @test
     */
    public function getVatIdInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getVatId()
        );
    }

    /**
     * @test
     */
    public function setVatIdSetsVatId(): void
    {
        $this->fixture->setVatId('VatId');

        $this->assertSame(
            'VatId',
            $this->fixture->getVatId()
        );
    }

    /**
     * @test
     */
    public function getEmailInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailSetsEmail(): void
    {
        $this->fixture->setEmail('Email');

        $this->assertSame(
            'Email',
            $this->fixture->getEmail()
        );
    }

    /**
     * @test
     */
    public function getUriInitiallyReturnsEmptyString(): void
    {
        $this->assertSame(
            '',
            $this->fixture->getUri()
        );
    }

    /**
     * @test
     */
    public function setUriSetsUri(): void
    {
        $this->fixture->setUri('Uri');

        $this->assertSame(
            'Uri',
            $this->fixture->getUri()
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
