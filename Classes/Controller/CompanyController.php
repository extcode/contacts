<?php

namespace Extcode\Contacts\Controller;

	/***************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2013
	 *  All rights reserved
	 *
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 3 of the License, or
	 *  (at your option) any later version.
	 *
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

/**
 *
 *
 * @package contacts
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class CompanyController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * companyRepository
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

	protected function initializeAction() {
		if ($GLOBALS['TSFE'] === NULL) {
			$this->pageId = (int) \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
		} else {
			$this->pageId = $GLOBALS['TSFE']->id;
		}

		$frameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$persistenceConfiguration = array('persistence' => array('storagePid' => $this->pageId));
		$this->configurationManager->setConfiguration(array_merge($frameworkConfiguration, $persistenceConfiguration));

		$this->piVars = $this->request->getArguments();
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$companies = $this->companyRepository->findAll( $this->piVars );

		$this->view->assign('piVars', $this->piVars);
		$this->view->assign('companies', $companies);
	}

	/**
	 * action show
	 *
	 * @param \Extcode\Contacts\Domain\Model\Company $company
	 * @return void
	 */
	public function showAction( \Extcode\Contacts\Domain\Model\Company $company = NULL ) {
		if ( !$company && intval($this->settings['company']) ) {
			$company = $this->companyRepository->findByUid( intval( $this->settings['company'] ) );
		}

		$this->view->assign('company', $company);
	}

}