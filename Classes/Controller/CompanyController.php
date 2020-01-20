<?php

namespace Extcode\Contacts\Controller;

use Extcode\Contacts\Domain\Model\Company;
use Extcode\Contacts\Domain\Model\Dto\CompanyDemand;
use Extcode\Contacts\Domain\Repository\CompanyRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CompanyController extends ActionController
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository = null;

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
     * @param CompanyRepository $companyRepository
     */
    public function injectCompanyRepository(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
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

        $companies = $this->companyRepository->findDemanded($demand);

        $this->view->assign('piVars', $this->request->getArguments());
        $this->view->assign('companies', $companies);
    }

    /**
     * @param Company $company
     */
    public function showAction(Company $company = null)
    {
        if (!$company && (int)$this->settings['company']) {
            $company = $this->companyRepository->findByUid((int)$this->settings['company']);
        }

        $this->view->assign('company', $company);
    }

    public function teaserAction()
    {
        $companies = $this->companyRepository->findByUids($this->settings['companyUids']);
        $this->view->assign('companies', $companies);
    }

    /**
     * Create the demand object which define which records will get shown
     *
     * @param array $settings
     *
     * @return CompanyDemand
     */
    protected function createDemandObjectFromSettings(array $settings) : CompanyDemand
    {
        $demand = $this->objectManager->get(
            CompanyDemand::class
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
     * @param CompanyDemand $demand
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
