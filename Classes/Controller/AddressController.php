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
use Extcode\Contacts\Domain\Repository\AddressRepository;

/**
 * Address Controller
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class AddressController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var AddressRepository
     */
    protected $addressRepository;

    /**
     * @param AddressRepository $addressRepository
     */
    public function injectAddressRepository(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * action show
     */
    public function showAction()
    {
        if ($this->settings['type'] == 'gmaps') {
            $this->view->setTemplatePathAndFilename(
                'typo3conf/ext/' .
                $this->request->getControllerExtensionKey() .
                '/Resources/Private/Templates/Address/ShowAsGmaps.html'
            );
        } elseif ($this->settings['type'] == 'osm') {
            $this->view->setTemplatePathAndFilename(
                'typo3conf/ext/' .
                $this->request->getControllerExtensionKey() .
                '/Resources/Private/Templates/Address/ShowAsGmaps.html'
            );
        }

        $address = $this->addressRepository->findByUid($this->settings['address']);

        $this->view->assign('address', $address);
    }
}
