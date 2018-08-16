<?php

defined('TYPO3_MODE') or die();

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

$_LLL = 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf';

$googleMapsLibrary = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('contacts', 'googleMapsLibrary');
$googleMapsApiKey = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('contacts', 'googleMapsApiKey');

if (!empty($googleMapsLibrary) && !empty($googleMapsApiKey)) {
    $googleMapsField = [
        'coords' => [
            'exclude' => 1,
            'config' => [
                'type' => 'user',
                'userFunc' => \Extcode\Contacts\Hooks\GoogleMapHook::class . '->render',
                'parameters' => [],
            ],
        ],
    ];

    ExtensionManagementUtility::addTCAcolumns(
        'tx_contacts_domain_model_address',
        $googleMapsField
    );
    ExtensionManagementUtility::addToAllTCAtypes(
        'tx_contacts_domain_model_address',
        '--linebreak, coords',
        '',
        'after:lon'
    );
}
