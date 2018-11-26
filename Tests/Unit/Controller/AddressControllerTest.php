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
use Nimut\TestingFramework\TestCase\UnitTestCase;

class AddressControllerTest extends UnitTestCase
{
    /**
     * @var \Extcode\Contacts\Controller\AddressController
     */
    protected $subject = null;

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\View\ViewInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $view = null;

    /**
     * @var \Extcode\Contacts\Domain\Repository\AddressRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $addressRepository = null;

    protected function setUp()
    {
        $this->subject = new \Extcode\Contacts\Controller\AddressController();

        $this->view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $this->view);

        $this->mockedObjectManager = $this->getMockBuilder(
            \TYPO3\CMS\Extbase\Object\ObjectManagerInterface::class
        )->getMock();
        $this->addressRepository = $this->getMockBuilder(\Extcode\Contacts\Domain\Repository\AddressRepository::class)
            ->setConstructorArgs(
                [
                    $this->mockedObjectManager
                ]
            )->getMock();
        $this->inject($this->subject, 'addressRepository', $this->addressRepository);
    }

    /**
     * @test
     */
    public function showActionCanBeCalled()
    {
        $this->subject->showAction();
    }
}
