<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'contacts');

/**
 * Register Frontend Plugins
 */
$pluginNames = [
    'Address',
    'Companies',
    'Contacts',
];

foreach ($pluginNames as $pluginName) {
    $pluginSignature = strtolower(str_replace('_', '', $_EXTKEY)) . '_' . strtolower($pluginName);
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Extcode.' . $_EXTKEY,
        $pluginName,
        $_LLL . ':tx_contacts.plugin.' . lcfirst($pluginName)
    );
    $flexFormPath = 'EXT:' . $_EXTKEY . '/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
    if (file_exists(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($flexFormPath))) {
        $TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
            $pluginSignature,
            'FILE:' . $flexFormPath
        );
    }
}

if (TYPO3_MODE === 'BE') {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
        'Extcode.' . $_EXTKEY,
        'web',
        'contacts',
        '',
        [
            'Contact' => 'list, show, edit, update',
            'Company' => 'list, show, edit, update',
        ],
        [
            'access' => 'admin',
            'icon' => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
            'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:tx_contacts.module.contacts',
        ]
    );
}

$tables = [
    'address',
    'contact',
    'company',
    'country',
    'phone',
];

foreach ($tables as $table) {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
        'tx_contacts_domain_model_' . $table,
        'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_' . $table . '.xlf'
    );
}
