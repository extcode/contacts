<?php

namespace Extcode\Contacts\Controller;

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

/**
 * Company Controller
 *
 * @package contacts
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class CompanyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Company Repository
     *
     * @var \Extcode\Contacts\Domain\Repository\CompanyRepository
     * @inject
     */
    protected $companyRepository;

    /**
     * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
     * @inject
     */
    protected $configurationManager;

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

    protected function initializeAction()
    {
        if ($GLOBALS['TSFE'] === null) {
            $this->pageId = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
        } else {
            $this->pageId = $GLOBALS['TSFE']->id;
        }

        $frameworkConfiguration = $this->configurationManager->getConfiguration(
            \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
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
     *
     * @return void
     */
    public function listAction()
    {
        $companies = $this->companyRepository->findAll($this->piVars);

        $this->view->assign('piVars', $this->piVars);
        $this->view->assign('companies', $companies);
    }

    /**
     * action show
     *
     * @param \Extcode\Contacts\Domain\Model\Company $company
     * @return void
     */
    public function showAction(\Extcode\Contacts\Domain\Model\Company $company = null)
    {
        if (!$company && intval($this->settings['company'])) {
            $company = $this->companyRepository->findByUid(intval($this->settings['company']));
        }

        $this->view->assign('company', $company);
    }

    /**
     * action teaser
     *
     * @return void
     */
    public function teaserAction()
    {
        $companies = $this->companyRepository->findByUids($this->settings['companyUids']);
        $this->view->assign('companies', $companies);
    }
}
