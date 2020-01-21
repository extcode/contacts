<?php

namespace Extcode\Contacts\Controller;

use Extcode\Contacts\Domain\Model\Contact;
use Extcode\Contacts\Domain\Model\Dto\ContactDemand;
use Extcode\Contacts\Domain\Repository\CategoryRepository;
use Extcode\Contacts\Domain\Repository\ContactRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ContactController extends ActionController
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var ContactRepository
     */
    protected $contactRepository = null;

    /**
     * @var int
     */
    protected $pageId;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

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

        $this->view->assign('piVars', $this->request->getArguments());
        $this->view->assign('contacts', $contacts);
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

    /**
     * Create the demand object which define which records will get shown
     *
     * @param array $settings
     *
     * @return ContactDemand
     */
    protected function createDemandObjectFromSettings(array $settings) : ContactDemand
    {
        $demand = $this->objectManager->get(
            ContactDemand::class
        );

        $arguments = $this->request->getArguments();
        if ($arguments['filter']) {
            $this->searchArguments = $arguments['filter'];
        }

        if ($arguments['filter']['searchString']) {
            $demand->setSearchString($arguments['filter']['searchString']);
        }

        $this->addCategoriesToDemandObjectFromSettings($demand);

        return $demand;
    }

    /**
     * @param ContactDemand $demand
     */
    protected function addCategoriesToDemandObjectFromSettings(&$demand)
    {
        if ($this->settings['categoriesList']) {
            $selectedCategories = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode(
                ',',
                $this->settings['categoriesList'],
                true
            );

            $categories = [];

            if ($this->settings['listSubcategories']) {
                foreach ($selectedCategories as $selectedCategory) {
                    $category = $this->categoryRepository->findByUid($selectedCategory);
                    $categories = array_merge(
                        $categories,
                        $this->categoryRepository->findSubcategoriesRecursiveAsArray($category)
                    );
                }
            } else {
                $categories = $selectedCategories;
            }

            $demand->setCategories($categories);
        }
    }
}
