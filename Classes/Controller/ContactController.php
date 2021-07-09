<?php

namespace Extcode\Contacts\Controller;

/*
 * This file is part of the package extcode/contacts.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Contact;
use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

class ContactController extends ActionController
{
    /**
     * @var ContactRepository
     */
    protected $contactRepository;

    /**
     * @var int
     */
    protected $pageId;

    public function injectContactRepository(ContactRepository $contactRepository): void
    {
        $this->contactRepository = $contactRepository;
    }

    protected function initializeAction(): void
    {
        if ($GLOBALS['TSFE'] === null) {
            $this->pageId = (int)GeneralUtility::_GP('id');
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

        if (!empty($GLOBALS['TSFE']) && is_object($GLOBALS['TSFE'])) {
            static $cacheTagsSet = false;

            /** @var $typoScriptFrontendController \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController */
            $typoScriptFrontendController = $GLOBALS['TSFE'];
            if (!$cacheTagsSet) {
                $typoScriptFrontendController->addCacheTags(['tx_contacts']);
                $cacheTagsSet = true;
            }
        }
    }

    public function listAction(): void
    {
        $demand = $this->createDemandObjectFromSettings($this->settings);
        $demand->setActionAndClass(__METHOD__, __CLASS__);

        $contacts = $this->contactRepository->findDemanded($demand);

        $this->view->assign('demand', $demand);
        $this->view->assign('contacts', $contacts);
        $this->view->assign('categories', $this->getSelectedCategories($demand));
    }

    public function showAction(Contact $contact = null): void
    {
        if (!$contact && (int)$this->settings['contact']) {
            $contact = $this->contactRepository->findByUid((int)$this->settings['contact']);
        }

        $this->view->assign('contact', $contact);

        $this->addCacheTags([$contact]);
    }

    public function teaserAction(): void
    {
        $contacts = $this->contactRepository->findByUids($this->settings['contactUids']);
        $this->view->assign('contacts', $contacts);

        $this->addCacheTags($contacts);
    }

    protected function addCacheTags(array $contacts): void
    {
        $cacheTags = [];

        foreach ($contacts as $contact) {
            // cache tag for each product record
            $cacheTags[] = 'tx_contacts_contact_' . $contact->getUid();
        }
        if (count($cacheTags) > 0) {
            $GLOBALS['TSFE']->addCacheTags($cacheTags);
        }
    }
}
