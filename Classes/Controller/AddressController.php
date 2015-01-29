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
class AddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * addressRepository
	 *
	 * @var \Extcode\Contacts\Domain\Repository\AddressRepository
	 * @inject
	 */
	protected $addressRepository;

	/**
	 * action show
	 *
	 * @return void
	 */
	public function showAction() {
		if ( $this->settings['type'] == 'gmaps' ) {
			$this->view->setTemplatePathAndFilename('typo3conf/ext/' .
				$this->request->getControllerExtensionKey() .
				'/Resources/Private/Templates/Address/ShowAsGmaps.html'
			);
		} elseif ( $this->settings['type'] == 'osm' ) {
			$this->view->setTemplatePathAndFilename('typo3conf/ext/' .
				$this->request->getControllerExtensionKey() .
				'/Resources/Private/Templates/Address/ShowAsGmaps.html'
			);
		}


		$address = $this->addressRepository->findByUid( $this->settings['address'] );

		$this->view->assign('address', $address);
	}

}