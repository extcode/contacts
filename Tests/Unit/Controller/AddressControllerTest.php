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
 * Address Controller Test
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class AddressControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
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

        $this->view = $this->getMock(
            \TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class
        );
        $this->inject($this->subject, 'view', $this->view);

        $this->addressRepository = $this->getMock(
            \Extcode\Contacts\Domain\Repository\AddressRepository::class,
            [],
            [],
            '',
            false
        );
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
