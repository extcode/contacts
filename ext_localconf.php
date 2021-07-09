<?php

defined('TYPO3_MODE') or die();

$_LLL_be = 'LLL:EXT:contacts/Resources/Private/Language/locallang_be.xlf';

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Contacts',
    'Contacts',
    [
        \Extcode\Contacts\Controller\ContactController::class => 'list, show, teaser',
    ],
    [
        \Extcode\Contacts\Controller\ContactController::class => 'list',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Contacts',
    'ContactTeaser',
    [
        \Extcode\Contacts\Controller\ContactController::class => 'teaser',
    ],
    [
        \Extcode\Contacts\Controller\ContactController::class => '',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Contacts',
    'Companies',
    [
        \Extcode\Contacts\Controller\CompanyController::class => 'list, show, teaser',
    ],
    [
        \Extcode\Contacts\Controller\CompanyController::class => 'list',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Contacts',
    'CompanyTeaser',
    [
        \Extcode\Contacts\Controller\CompanyController::class => 'teaser',
    ],
    [
        \Extcode\Contacts\Controller\CompanyController::class => '',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Contacts',
    'AddressSearch',
    [
        \Extcode\Contacts\Controller\AddressController::class => 'search',
    ],
    [
        \Extcode\Contacts\Controller\AddressController::class => 'search',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Contacts',
    'Address',
    [
        \Extcode\Contacts\Controller\AddressController::class => 'show',
    ],
    [
        \Extcode\Contacts\Controller\AddressController::class => '',
    ]
);

// register "contacts:" namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['contacts'][]
    = 'Extcode\\Contacts\\ViewHelpers';

// update wizard for slugs
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['ext/install']['update']['contactsSlugUpdater'] =
    \Extcode\Contacts\Updates\SlugUpdater::class;

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
