<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3_MODE') or die();

call_user_func(function () {
    $_LLL_db = 'LLL:' . 'EXT:contacts/Resources/Private/Language/locallang_db.xlf';

    $pluginNames = [
        'Address',
        'AddressSearch',
        'Companies',
        'CompanyTeaser',
        'Contacts',
        'ContactTeaser',
    ];

    foreach ($pluginNames as $pluginName) {
        $pluginSignature = 'contacts_' . strtolower($pluginName);
        ExtensionUtility::registerPlugin(
            'Contacts',
            $pluginName,
            $_LLL_db . ':tx_contacts.plugin.' . lcfirst($pluginName)
        );
        $flexFormPath = 'EXT:contacts/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
        if (file_exists(GeneralUtility::getFileAbsFileName($flexFormPath))) {
            $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
            ExtensionManagementUtility::addPiFlexFormValue(
                $pluginSignature,
                'FILE:' . $flexFormPath
            );
        }
    }

    $GLOBALS['TCA']['tt_content']['columns']['tx_contacts_domain_model_address']['config']['type'] = 'passthrough';
    $GLOBALS['TCA']['tt_content']['columns']['tx_contacts_domain_model_company']['config']['type'] = 'passthrough';
    $GLOBALS['TCA']['tt_content']['columns']['tx_contacts_domain_model_contact']['config']['type'] = 'passthrough';
});
