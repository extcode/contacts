<?php

namespace Extcode\Contacts\Controller;

use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class ContactController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
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
        if ($GLOBALS['TSFE'] === null) {
            $this->pageId = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
        } else {
            $this->pageId = $GLOBALS['TSFE']->id;
        }

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
     */
    public function showAction(\Extcode\Contacts\Domain\Model\Contact $contact = null)
    {
        if (!$contact && (int)$this->settings['contact']) {
            $contact = $this->contactRepository->findByUid((int)$this->settings['contact']);
        }

        $this->view->assign('contact', $contact);
    }

    /**
     * action teaser
     */
    public function teaserAction()
    {
        $contacts = $this->contactRepository->findByUids($this->settings['contactUids']);
        $this->view->assign('contacts', $contacts);
    }
}
