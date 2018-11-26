<?php

defined('TYPO3_MODE') or die();

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
