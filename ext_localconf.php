<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.' . $_EXTKEY,
    'Contacts',
    [
        'Contact' => 'list, show, teaser',
    ],
    [
        'Contact' => '',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.' . $_EXTKEY,
    'Companies',
    [
        'Company' => 'list, show, teaser',
    ],
    [
        'Company' => '',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.' . $_EXTKEY,
    'Address',
    [
        'Address' => 'show',
    ],
    []
);
