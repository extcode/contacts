<?php

namespace Extcode\Contacts\Hooks;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Contacts\Domain\Repository\CountryRepository;

class GoogleMapHook
{
    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var CountryRepository
     */
    protected $countryRepository;

    /**
     * @var array
     */
    protected $pluginSettings = [];

    /**
     * @var string
     */
    protected $tableName = '';

    /**
     * @var string
     */
    protected $mapId = '';

    /**
     * @var string
     */
    protected $latFieldName = 'lat';

    /**
     * @var string
     */
    protected $lonFieldName = 'lon';

    /**
     * @var float
     */
    protected $latitude = 51.439310;

    /**
     * @var float
     */
    protected $longitude = 9.997579;

    /**
     * @param array $params
     */
    protected function init(array $params)
    {
        $this->objectManager = new \TYPO3\CMS\Extbase\Object\ObjectManager();

        $this->countryRepository = $this->objectManager->get(
            CountryRepository::class
        );

        $querySettings = $this->countryRepository->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->countryRepository->setDefaultQuerySettings($querySettings);

        $this->tableName = $params['table'];
        $this->mapId = $this->tableName . '_map';

        $this->setLatLonFieldNames($params);
        $this->setLatLon($params);
    }

    /**
     * Renders the Google map.
     *
     * @param array $params
     * @param $fObj
     *
     * @return string
     */
    public function render(array $params, $fObj)
    {
        $this->init($params);

        $extensionConfArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['contacts']);
        $googleMapsLibrary = $extensionConfArr['googleMapsLibrary'];

        if ($extensionConfArr['googleMapsApiKey']) {
            $googleMapsLibrary .=  '&key=' . $extensionConfArr['googleMapsApiKey'];
        }

        $this->tableName = $params['table'];
        $this->mapId = $this->tableName . '_map';

        $out = $this->getJavaScript($googleMapsLibrary);
        $out .= $this->getInputFields($params);

        return $out;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    protected function concatenateFieldsToAddress(array $params): string
    {
        $address = [];

        if (!empty($params['row']['street'])) {
            $street = $params['row']['street'];
            if (!empty($params['row']['street_number'])) {
                $street .= ' ' . $params['row']['street_number'];
            }
            $address[] = $street;
        }
        if (!empty($params['row']['zip'])) {
            $address[] = $params['row']['zip'];
        }
        if (!empty($params['row']['city'])) {
            $address[] = $params['row']['city'];
        }

        $country = $this->retrieveCountryCode((int)$params['row']['country'][0]);
        if ($country) {
            $address[] = strtoupper($country);
        }

        $addressString = implode(', ', $address);

        return $addressString;
    }

    /**
     * @param int $countryId
     *
     * @return string
     */
    protected function retrieveCountryCode(int $countryId): string
    {
        $country = $this->countryRepository->findOneByUid($countryId);

        if ($country) {
            $countryCode = $country->getIso2();

            return $countryCode;
        }

        return '';
    }

    /**
     * @param string $googleMapsLibrary
     *
     * @return string
     */
    protected function getJavaScript(string $googleMapsLibrary): string
    {
        $version = \TYPO3\CMS\Core\Utility\VersionNumberUtility::convertVersionNumberToInteger(TYPO3_version);

        $out = '';

        $out .= '<script type="text/javascript" src="' . $googleMapsLibrary . '"></script>';
        $out .= '<script type="text/javascript">';
        $out .= "var latitude = {$this->latitude};";
        $out .= "var longitude = {$this->longitude};";
        $out .= "var tableName = '{$this->tableName}';";
        $out .= "var latitudeField = '{$this->latFieldName}';";
        $out .= "var longitudeField = '{$this->lonFieldName}';";
        $out .= "var mapId = '{$this->mapId}';";
        $out .= "var version = {$version};";
        $out .= '</script>';
        $out .= '<script type="text/javascript" src="/typo3conf/ext/contacts/Resources/Public/JavaScripts/Backend/google_maps_hook.js"></script>';

        return $out;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    protected function getInputFields(array $params): string
    {
        $address = $this->concatenateFieldsToAddress($params);

        $this->tableName = $params['table'];
        $this->mapId = $this->tableName . '_map';

        $out = '';

        $out .= '<div id="' . $this->tableName . '">';
        $out .= '<input id="inputAddress" type="textbox" value="' . $address . '" style="width:300px">';
        $out .= '<input type="button" value="Search" onclick="TxContacts.codeAddress()">';
        $out .= '<div id="' . $this->mapId . '" style="height:420px;width:640px; border: 1px solid #bbbbbb; margin-top: 15px;"></div>';
        $out .= '</div>';

        return $out;
    }

    /**
     * @param array $params
     */
    protected function setLatLon(array $params)
    {
        $latitude = (float)$params['row'][$this->latFieldName];
        $longitude = (float)$params['row'][$this->lonFieldName];

        if ($latitude && $longitude) {
            $this->latitude = $latitude;
            $this->longitude = $longitude;
        }
    }

    /**
     * @param array $params
     */
    protected function setLatLonFieldNames(array $params)
    {
        $dataPrefix = 'data[' . $this->tableName . '][' . $params['row']['uid'] . ']';
        if ($params['parameters']['latitude']) {
            $this->latFieldName = $dataPrefix . '[' . $params['parameters']['latitudeField'] . ']';
        }
        if ($params['parameters']['longitude']) {
            $this->lonFieldName = $dataPrefix . '[' . $params['parameters']['longitudeField'] . ']';
        }
    }
}
