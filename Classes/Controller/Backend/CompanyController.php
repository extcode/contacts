<?php

namespace Extcode\Contacts\Controller\Backend;

use Extcode\Contacts\Domain\Model\Company;
use Extcode\Contacts\Domain\Repository\CompanyRepository;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class CompanyController extends ActionController
{
    /**
     * @var CompanyRepository
     */
    protected $companyRepository = null;

    /**
     * @var int
     */
    protected $pageId;

    /**
     * @var array
     */
    protected $piVars = [];

    /**
     * @param CompanyRepository $companyRepository
     */
    public function injectCompanyRepository(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
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
        $companies = $this->companyRepository->findAll($this->piVars);

        $this->view->assign('piVars', $this->piVars);
        $this->view->assign('companies', $companies);
    }

    /**
     * @param Company $company
     *
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("company")
     */
    public function showAction(Company $company)
    {
        $this->view->assign('company', $company);
    }
}
