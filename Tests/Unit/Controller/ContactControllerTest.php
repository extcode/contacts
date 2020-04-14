<?php

namespace Extcode\Contacts\Tests\Unit\Controller;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Controller\ContactController;
use Extcode\Contacts\Domain\Model\Dto\Demand;
use Extcode\Contacts\Domain\Repository\ContactRepository;
use Nimut\TestingFramework\TestCase\UnitTestCase;

class ContactControllerTest extends UnitTestCase
{
    /**
     * @var \Extcode\Contacts\Controller\ContactController
     */
    protected $fixture = null;

    /**
     * @var ContactRepository
     */
    protected $contactRepository = null;

    protected function setUp()
    {
        $this->fixture = new ContactController();

        $this->contactRepository = $this->prophesize(ContactRepository::class);
    }

    public function tearDown()
    {
        unset($this->fixture, $this->contactRepository);
    }

    /**
     * @test
     */
    public function listActionCanBeCalled()
    {
        $demand = new Demand();
        $settings = ['category' => '25'];

        $fixture = $this->getAccessibleMock(
            \Extcode\Contacts\Controller\ContactController::class,
            ['createDemandObjectFromSettings', 'getSelectedCategories']
        );

        $fixture->_set('contactRepository', $this->contactRepository->reveal());
        $fixture->injectConfigurationManager(
            $this->getMockBuilder(
                \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::class
            )->getMock()
        );

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($fixture, 'view', $view);

        $mockRequest = $this->getMockBuilder(
            \TYPO3\CMS\Extbase\Mvc\Request::class
        )->getMock();
        $mockRequest->expects($this->any())->method('getArguments')->willReturn([]);
        $this->inject($fixture, 'request', $mockRequest);

        $fixture->_set('settings', $settings);

        $fixture->expects($this->once())->method('createDemandObjectFromSettings')
            ->will($this->returnValue($demand));
        $fixture->expects($this->once())->method('getSelectedCategories');

        $this->contactRepository->findDemanded($demand)->shouldBeCalled();

        $fixture->listAction();

        // datetime must be removed
        $this->assertEquals($fixture->_get('settings'), ['category' => '25']);
    }
}
