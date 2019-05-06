<?php

defined('TYPO3_MODE') or die();

$_LLL_be = 'LLL:EXT:contacts/Resources/Private/Language/locallang_be.xlf';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.contacts',
    'Contacts',
    [
        'Contact' => 'list, show, teaser',
    ],
    [
        'Contact' => '',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.contacts',
    'Companies',
    [
        'Company' => 'list, show, teaser',
    ],
    [
        'Company' => '',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.contacts',
    'Address',
    [
        'Address' => 'show',
    ],
    [
        'Address' => '',
    ]
);

// register layouts
$GLOBALS['TYPO3_CONF_VARS']['EXT']['contacts']['templateLayouts']['address'][] = [$_LLL_be . ':flexforms_template.templateLayout.address.gmaps', 'gmaps'];
