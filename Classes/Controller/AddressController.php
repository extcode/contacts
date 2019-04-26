<?php

namespace Extcode\Contacts\Controller;

use Extcode\Contacts\Domain\Repository\AddressRepository;

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
