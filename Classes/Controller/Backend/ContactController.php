<?php

namespace Extcode\Contacts\Controller\Backend;

use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

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
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation $contact
     */
    public function showAction(\Extcode\Contacts\Domain\Model\Contact $contact = null)
    {
        $this->view->assign('contact', $contact);
    }
}
