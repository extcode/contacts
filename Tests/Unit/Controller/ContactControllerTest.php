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
 * Contact Controller Test
 *
 * @package contacts
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class ContactControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \Extcode\Contacts\Controller\ContactController
     */
    protected $subject = null;

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\View\ViewInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $view = null;

    /**
     * @var \Extcode\Contacts\Domain\Repository\ContactRepository|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $contactRepository = null;

    protected function setUp()
    {
        $this->subject = new \Extcode\Contacts\Controller\ContactController();

        $this->view = $this->getMock(
            \TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class
        );
        $this->inject($this->subject, 'view', $this->view);

        $this->contactRepository = $this->getMock(
            \Extcode\Contacts\Domain\Repository\ContactRepository::class,
            array(),
            array(),
            '',
            false
        );
        $this->inject($this->subject, 'contactRepository', $this->contactRepository);
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
    public function listActionPassesAllContactsAsContactsToView()
    {
        $contacts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();

        $this->contactRepository
            ->expects(self::any())
            ->method('findAll')
            ->will(self::returnValue($contacts));

        $this->view->expects(self::at(1))->method('assign')->with('contacts', $contacts);

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
    public function showActionWithNoContactPassesNullAsContactToView()
    {
        $this->view->expects(self::once())->method('assign')->with('contact', null);
        $this->subject->showAction();
    }

    /**
     * @test
     */
    public function showActionWithContactPassesContactAsContactToView()
    {
        $contact = new \Extcode\Contacts\Domain\Model\Contact(
            'salutation',
            'title',
            'firstName',
            'lastName'
        );

        $this->contactRepository
            ->expects(self::any())
            ->method('findByUid')
            ->will(self::returnValue($contact));

        $this->view->expects(self::once())->method('assign')->with('contact', $contact);

        $this->subject->showAction($contact);
    }
}