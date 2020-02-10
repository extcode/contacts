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
        'Contact' => 'list',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.contacts',
    'ContactTeaser',
    [
        'Contact' => 'teaser',
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
        'Company' => 'list',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.contacts',
    'CompanyTeaser',
    [
        'Company' => 'teaser',
    ],
    [
        'Company' => '',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.contacts',
    'AddressSearch',
    [
        'Address' => 'search',
    ],
    [
        'Address' => 'search',
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

// register "contacts:" namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['contacts'][]
    = 'Extcode\\Contacts\\ViewHelpers';

// clearCachePostProc Hook

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['contacts_clearcache'] =
    \Extcode\Contacts\Hooks\DataHandler::class . '->clearCachePostProc';

// provide extension configuration for TypoScript
$extensionConfiguration = new \TYPO3\CMS\Core\Configuration\ExtensionConfiguration();
$contactsConfiguration = $extensionConfiguration->get('contacts');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.tx_contacts.googleMapsApiKey=' . $contactsConfiguration['googleMapsApiKey']);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.tx_contacts.googleMapsLibrary=' . $contactsConfiguration['googleMapsLibrary']);


// register class to be available in 'eval' of TCA
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\Extcode\Contacts\DataHandler\EvalFloat8::class] = '';

// register layouts
$GLOBALS['TYPO3_CONF_VARS']['EXT']['contacts']['templateLayouts']['address'][] = [$_LLL_be . ':flexforms_template.templateLayout.address.gmaps', 'gmaps'];

$GLOBALS['TYPO3_CONF_VARS']['EXT']['contacts']['templateLayouts']['contact_teaser'][] = [$_LLL_be . ':flexforms_template.templateLayout.contact_teaser.default', 'default'];
$GLOBALS['TYPO3_CONF_VARS']['EXT']['contacts']['templateLayouts']['company_teaser'][] = [$_LLL_be . ':flexforms_template.templateLayout.company_teaser.default', 'default'];
