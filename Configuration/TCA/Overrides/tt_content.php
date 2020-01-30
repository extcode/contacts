<?php

defined('TYPO3_MODE') or die();

call_user_func(function () {
    $_LLL_db = 'LLL:' . 'EXT:contacts/Resources/Private/Language/locallang_db.xlf';

    $pluginNames = [
        'Address',
        'Companies',
        'CompanyTeaser',
        'Contacts',
        'ContactTeaser',
    ];

    foreach ($pluginNames as $pluginName) {
        $pluginSignature = 'contacts_' . strtolower($pluginName);
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'Extcode.contacts',
            $pluginName,
            $_LLL_db . ':tx_contacts.plugin.' . lcfirst($pluginName)
        );
        $flexFormPath = 'EXT:contacts/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
        if (file_exists(\TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($flexFormPath))) {
            $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
                $pluginSignature,
                'FILE:' . $flexFormPath
            );
        }
    }

    $GLOBALS['TCA']['tt_content']['columns']['tx_contacts_domain_model_address']['config']['type'] = 'passthrough';
    $GLOBALS['TCA']['tt_content']['columns']['tx_contacts_domain_model_company']['config']['type'] = 'passthrough';
    $GLOBALS['TCA']['tt_content']['columns']['tx_contacts_domain_model_contact']['config']['type'] = 'passthrough';
});
