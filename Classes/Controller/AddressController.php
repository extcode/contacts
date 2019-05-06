<?php

namespace Extcode\Contacts\Controller;

use Extcode\Contacts\Domain\Repository\AddressRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class AddressController extends ActionController
{
    /**
     * @var AddressRepository
     */
    protected $addressRepository = null;

    /**
     * @param AddressRepository $addressRepository
     */
    public function injectAddressRepository(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    public function showAction()
    {
        $address = $this->addressRepository->findByUid($this->settings['address']);

        $this->view->assign('address', $address);
    }
}
