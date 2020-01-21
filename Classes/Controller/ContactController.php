<?php

namespace Extcode\Contacts\Controller;

use Extcode\Contacts\Domain\Model\Contact;
use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

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
    }

    public function listAction()
    {
        $demand = $this->createDemandObjectFromSettings($this->settings);
        $demand->setActionAndClass(__METHOD__, __CLASS__);

        $contacts = $this->contactRepository->findDemanded($demand);

        $this->view->assign('demand', $demand);
        $this->view->assign('contacts', $contacts);
        $this->view->assign('categories', $this->getSelectedCategories($demand));
    }

    /**
     * @param Contact $contact
     */
    public function showAction(Contact $contact = null)
    {
        if (!$contact && (int)$this->settings['contact']) {
            $contact = $this->contactRepository->findByUid((int)$this->settings['contact']);
        }

        $this->view->assign('contact', $contact);
    }

    public function teaserAction()
    {
        $contacts = $this->contactRepository->findByUids($this->settings['contactUids']);
        $this->view->assign('contacts', $contacts);
    }
}
