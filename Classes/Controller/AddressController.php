<?php

namespace Extcode\Contacts\Controller;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Model\Address;
use Extcode\Contacts\Domain\Repository\AddressRepository;
use Extcode\Contacts\Domain\Repository\ZipRepository;
use Extcode\Contacts\Hooks\AddressSearchAddressesLoadedHookInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class AddressController extends ActionController
{
    /**
     * @var AddressRepository
     */
    protected $addressRepository = null;

    /**
     * @var ZipRepository
     */
    protected $zipRepository = null;

    /**
     * @param AddressRepository $addressRepository
     */
    public function injectAddressRepository(AddressRepository $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param ZipRepository $zipRepository
     */
    public function injectZipRepository(ZipRepository $zipRepository)
    {
        $this->zipRepository = $zipRepository;
    }

    public function searchAction()
    {
        if ($this->request->hasArgument('tx_contacts_addresssearch')) {
            $addressSearchArgs = $this->request->getArgument('tx_contacts_addresssearch');
            $country = $addressSearchArgs['country'];
            $searchWord = $addressSearchArgs['searchWord'];
            $zip = $addressSearchArgs['zip'];
            $radius = $addressSearchArgs['radius'];
        } else {
            $addressSearchArgs = [];
        }

        $this->view->assign('searchWord', $searchWord);
        $this->view->assign('zip', $zip);
        $this->view->assign('radius', $radius);

        if ($zip) {
            $point = $this->zipRepository->findByCountryAndZip('DE', $zip, $this->settings['zipMapFile']);
        }

        $pid = $this->getRecordStoragePage();

        if (is_array($point)) {
            $addresses = $this->addressRepository->findByDistance((float)$point['lat'], (float)$point['lon'], (int)$radius, $pid, (string)$searchWord);
        } else {
            $addresses = $this->addressRepository->findByDistance(0.0, 0.0, 0, $pid, (string)$searchWord);
        }

        if ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['contacts']['AddressSearchAddressesLoadedHook']) {
            foreach ($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['contacts']['AddressSearchAddressesLoadedHook'] as $className) {
                $_procObj = GeneralUtility::makeInstance($className);
                if (!$_procObj instanceof AddressSearchAddressesLoadedHookInterface) {
                    throw new \UnexpectedValueException($className . ' must implement interface ' . AddressSearchAddressesLoadedHookInterface::class, 123);
                }

                $addresses = $_procObj->enrichAddresses($addresses, $addressSearchArgs);
            }
        }

        $this->view->assign('addresses', $addresses);
    }

    /**
     * @param Address|null $address
     */
    public function showAction(Address $address = null)
    {
        if (!$address) {
            $address = $this->addressRepository->findByUid($this->settings['address']);
        }

        $this->view->assign('address', $address);
    }

    /**
     * @return mixed
     */
    protected function getRecordStoragePage()
    {
        $frameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $pid = $frameworkConfiguration['persistence']['storagePid'];
        return $pid;
    }
}
