<?php
defined('TYPO3_MODE') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// Extension manager configuration
$configuration = \Extcode\Contacts\Utility\EmConfiguration::getSettings();

$_LLL_db = 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:';

ExtensionManagementUtility::makeCategorizable(
    'contacts',
    'tx_contacts_domain_model_contact',
    'category',
    [
        'label' => $_LLL_db . 'tx_contacts_domain_model_contact.category',
        'fieldConfiguration' => [
            'minitems' => 0,
            'maxitems' => 1,
            'multiple' => false,
        ]
    ]
);

ExtensionManagementUtility::makeCategorizable(
    'contacts',
    'tx_contacts_domain_model_contact',
    'categories',
    [
        'label' => $_LLL_db . 'tx_contacts_domain_model_contact.categories'
    ]
);

// category restriction based on settings in extension manager
$categoryRestrictionSetting = $configuration->getCategoryRestriction();

if ($categoryRestrictionSetting) {
    $categoryRestriction = '';
    switch ($categoryRestrictionSetting) {
        case 'current_pid':
            $categoryRestriction = ' AND sys_category.pid=###CURRENT_PID### ';
            break;
        case 'siteroot':
            $categoryRestriction = ' AND sys_category.pid IN (###SITEROOT###) ';
            break;
        case 'page_tsconfig':
            $categoryRestriction = ' AND sys_category.pid IN (###PAGE_TSCONFIG_IDLIST###) ';
            break;
        default:
            $categoryRestriction = '';
    }

    // prepend category restriction at the beginning of foreign_table_where
    if (!empty($categoryRestriction)) {
        $GLOBALS['TCA']['tx_contacts_domain_model_contact']['columns']['category']['config']['foreign_table_where'] = $categoryRestriction .
            $GLOBALS['TCA']['tx_contacts_domain_model_contact']['columns']['category']['config']['foreign_table_where'];
        $GLOBALS['TCA']['tx_contacts_domain_model_contact']['columns']['categories']['config']['foreign_table_where'] = $categoryRestriction .
            $GLOBALS['TCA']['tx_contacts_domain_model_contact']['columns']['categories']['config']['foreign_table_where'];
    }
}
