<?php

namespace Extcode\Contacts\Controller;

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
    protected $piVars;

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
}
