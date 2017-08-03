<?php

namespace Extcode\Contacts\Hooks;

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
 * Google Map Hook
 *
 * @author Daniel Lorenz <ext.contacts@extco.de>
 */
class GoogleMapHook
{
    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Extcode\Contacts\Domain\Repository\CountryRepository
     */
    protected $countryRepository;

    /**
     * @var array
     */
    protected $pluginSettings;

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
    protected function init($params)
    {
        $this->objectManager = new \TYPO3\CMS\Extbase\Object\ObjectManager();

        $this->countryRepository = $this->objectManager->get(
            \Extcode\Contacts\Domain\Repository\CountryRepository::class
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
     * @return string
     */
    public function render($params, $fObj)
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
    protected function concatenateFieldsToAddress($params)
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

        $country = $this->retrieveCountryCode($params['row']['country'][0]);
        if ($country) {
            $address[] = strtoupper($country);
        }

        $addressString = implode(', ', $address);

        return $addressString;
    }

    /**
     * @param $countryId
     *
     * @return string
     */
    protected function retrieveCountryCode($countryId)
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
    protected function getJavaScript($googleMapsLibrary)
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
    protected function getInputFields($params)
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
    protected function setLatLon($params)
    {
        $latitude = (float)$params['row'][$this->latFieldName];
        $longitude = (float)$params['row'][$this->lonFieldName];

        if ($latitude && $longitude) {
            $this->latitude = $latitude;
            $this->longitude = $longitude;
        }
    }

    /**
     * @param $params
     */
    protected function setLatLonFieldNames($params)
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
