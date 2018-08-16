<?php

namespace Extcode\Contacts\Controller\Backend;

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
use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * Contact Controller
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class ContactController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Contact Repository
     *
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * pageId
     *
     * @var int
     */
    protected $pageId;

    /**
     * PiVars
     *
     * @var array
     */
    protected $piVars;

    /**
     * @param ContactRepository $contactRepository
     */
    public function injectContactRepository(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    protected function initializeAction()
    {
        $this->pageId = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');

        $frameworkConfiguration = $this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
        );
        $persistenceConfiguration = [
            'persistence' => [
                'storagePid' => $this->pageId,
            ],
        ];
        $this->configurationManager->setConfiguration(array_merge($frameworkConfiguration, $persistenceConfiguration));

        $this->piVars = $this->request->getArguments();
    }

    /**
     * action list
     */
    public function listAction()
    {
        $contacts = $this->contactRepository->findAll($this->piVars);

        $this->view->assign('piVars', $this->piVars);
        $this->view->assign('contacts', $contacts);
    }

    /**
     * action show
     *
     * @param \Extcode\Contacts\Domain\Model\Contact $contact
     *
     * @ignorevalidation $contact
     */
    public function showAction(\Extcode\Contacts\Domain\Model\Contact $contact = null)
    {
        $this->view->assign('contact', $contact);
    }
}
