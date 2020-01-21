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

// provide extension configuration for TypoScript
$extensionConfiguration = new \TYPO3\CMS\Core\Configuration\ExtensionConfiguration();
$contactsConfiguration = $extensionConfiguration->get('contacts');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.tx_contacts.googleMapsApiKey=' . $contactsConfiguration['googleMapsApiKey']);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptConstants('plugin.tx_contacts.googleMapsLibrary=' . $contactsConfiguration['googleMapsLibrary']);


// register class to be available in 'eval' of TCA
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tce']['formevals'][\Extcode\Contacts\DataHandler\EvalFloat8::class] = '';

// register layouts
$GLOBALS['TYPO3_CONF_VARS']['EXT']['contacts']['templateLayouts']['address'][] = [$_LLL_be . ':flexforms_template.templateLayout.address.gmaps', 'gmaps'];
