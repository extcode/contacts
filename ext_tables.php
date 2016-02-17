<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Extcode.' . $_EXTKEY,
    'Contacts',
    'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts.plugin.contacts'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Extcode.' . $_EXTKEY,
    'Companies',
    'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts.plugin.companies'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Extcode.' . $_EXTKEY,
    'Address',
    'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts.plugin.address'
);

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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'contacts');

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

$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Address');
$pluginSignature = $extensionName . '_' . $pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Address.xml'
);


$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Contacts');
$pluginSignature = $extensionName . '_' . $pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Contacts.xml'
);


$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Companies');
$pluginSignature = $extensionName . '_' . $pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Companies.xml'
);
