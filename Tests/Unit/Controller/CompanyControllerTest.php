<?php

namespace Extcode\Contacts\Tests\Unit\Controller;

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
 * Company Controller Test
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class CompanyControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Contacts\Controller\CompanyController
     */
    protected $subject = null;

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\View\ViewInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $view = null;

    /**
     * @var \Extcode\Contacts\Domain\Repository\CompanyRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $companyRepository = null;

    protected function setUp()
    {
        $this->subject = new \Extcode\Contacts\Controller\CompanyController();

        $this->view = $this->getMock(
            \TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class
        );
        $this->inject($this->subject, 'view', $this->view);

        $this->companyRepository = $this->getMock(
            \Extcode\Contacts\Domain\Repository\CompanyRepository::class,
            [],
            [],
            '',
            false
        );
        $this->inject($this->subject, 'companyRepository', $this->companyRepository);
    }

    /**
     * @test
     */
    public function listActionCanBeCalled()
    {
        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function listActionPassesAllCompaniesAsCompaniesToView()
    {
        $companies = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

        $this->companyRepository
            ->expects(self::any())
            ->method('findAll')
            ->will(self::returnValue($companies));

        $this->view->expects(self::at(1))->method('assign')->with('companies', $companies);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionCanBeCalled()
    {
        $this->subject->showAction();
    }

    /**
     * @test
     */
    public function showActionWithNoCompanyPassesNullAsCompanyToView()
    {
        $this->view->expects(self::once())->method('assign')->with('company', null);
        $this->subject->showAction();
    }

    /**
     * @test
     */
    public function showActionWithCompanyPassesContactAsContactToView()
    {
        $company = new \Extcode\Contacts\Domain\Model\Company('company');

        $this->companyRepository
            ->expects(self::any())
            ->method('findByUid')
            ->will(self::returnValue($company));

        $this->view->expects(self::once())->method('assign')->with('company', $company);

        $this->subject->showAction($company);
    }
}
