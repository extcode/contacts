<?php

namespace Extcode\Contacts\Controller\Backend;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Contact;
use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ContactController extends ActionController
{
    /**
     * @var ContactRepository
     */
    protected $contactRepository = null;

    /**
     * @var int
     */
    protected $pageId;

    /**
     * @var array
     */
    protected $piVars = [];

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

    public function listAction()
    {
        $contacts = $this->contactRepository->findAll($this->piVars);

        $this->view->assign('piVars', $this->piVars);
        $this->view->assign('contacts', $contacts);
    }

    /**
     * @param Contact $contact
     *
     * @ignorevalidation $contact
     */
    public function showAction(Contact $contact)
    {
        $this->view->assign('contact', $contact);
    }
}
