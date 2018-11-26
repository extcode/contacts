<?php

defined('TYPO3_MODE') or die();

$extensionConfArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['contacts']);
$googleMapsLibrary = $extensionConfArr['googleMapsLibrary'];
$googleMapsApiKey = $extensionConfArr['googleMapsApiKey'];

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

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
        'tx_contacts_domain_model_address',
        $googleMapsField
    );
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
        'tx_contacts_domain_model_address',
        '--linebreak, coords',
        '',
        'after:lon'
    );
}
