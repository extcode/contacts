<?php

namespace Extcode\Contacts\Tests\Domain\Model;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Nimut\TestingFramework\TestCase\UnitTestCase;

class CompanyTest extends UnitTestCase
{
    /**
     * Name
     *
     * @var string
     */
    protected $name;

    /**
     * @var \Extcode\Contacts\Domain\Model\Company
     */
    protected $fixture = null;

    /**
     *
     */
    public function setUp()
    {
        $this->name = 'Name';

        $this->fixture = new \Extcode\Contacts\Domain\Model\Company($this->name);
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
    public function getNameInitiallyReturnsName()
    {
        $this->assertSame(
            $this->name,
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

    /**
     * @test
     */
    public function setNameWithEmptyStringThrowsException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The name can not be blank.');
        $this->expectExceptionCode(1373527548);

        $this->fixture->setName('');
    }

    /**
     * @test
     */
    public function getLegalNameInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getLegalName()
        );
    }

    /**
     * @test
     */
    public function setLegalNameSetsLegalName()
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
    public function getLegalFormInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getLegalForm()
        );
    }

    /**
     * @test
     */
    public function setLegalFormSetsLegalForm()
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
    public function getRegisteredOfficeInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getRegisteredOffice()
        );
    }

    /**
     * @test
     */
    public function setRegisteredOfficeSetsRegisteredOffice()
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
    public function getRegisterCourtInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getRegisterCourt()
        );
    }

    /**
     * @test
     */
    public function setRegisterCourtSetsRegisterCourt()
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
    public function getRegisterNumberInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getRegisterNumber()
        );
    }

    /**
     * @test
     */
    public function setRegisterNumberSetsRegisterNumber()
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
    public function getVatIdInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getVatId()
        );
    }

    /**
     * @test
     */
    public function setVatIdSetsVatId()
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
    public function getEmailInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getEmail()
        );
    }

    /**
     * @test
     */
    public function setEmailSetsEmail()
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
    public function getUriInitiallyReturnsEmptyString()
    {
        $this->assertSame(
            '',
            $this->fixture->getUri()
        );
    }

    /**
     * @test
     */
    public function setUriSetsUri()
    {
        $this->fixture->setUri('Uri');

        $this->assertSame(
            'Uri',
            $this->fixture->getUri()
        );
    }
}
