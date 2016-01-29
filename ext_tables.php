<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
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
		array(
			'Contact' => 'list, show, edit, update',
			'Company' => 'list, show, edit, update',
		),
		array(
			'access' => 'admin',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_db.xlf:tx_contacts.module.contacts',
		)
	);
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'contacts');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_address', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_address.xlf');\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_contacts_domain_model_address');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_contact', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_contact.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_company', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_company.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_phone', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_phone.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_country', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_country.xlf');
