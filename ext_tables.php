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
$TCA['tx_contacts_domain_model_address'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address',
		'label' => 'street',
		'label_alt' => 'street_number, zip, city, country',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'street,zip,city',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Address.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_address.png'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_contact', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_contact.xlf');
$TCA['tx_contacts_domain_model_contact'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_contact',
		'label' => 'first_name',
		'label_alt' => 'last_name',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'first_name,last_name,addresses,',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Contact.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_contact.png'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_company', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_company.xlf');
$TCA['tx_contacts_domain_model_company'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'street,zip,city',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Company.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_company.png'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_phone', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_phone.xlf');
$TCA['tx_contacts_domain_model_phone'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_phone',
		'label' => 'number',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'street,zip,city',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Phone.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_phone.png'
	),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_contacts_domain_model_country', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_country.xlf');
$TCA['tx_contacts_domain_model_country'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_country',
		'label' => 'name',
		'label_alt' => 'iso2',
		'label_alt_force' => 1,
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'iso,name',
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Country.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_country.png'
	),
);

$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Address');
$pluginSignature = $extensionName.'_'.$pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/Address.xml');


$extensionName = strtolower(\TYPO3\CMS\Core\Utility\GeneralUtility::underscoredToUpperCamelCase($_EXTKEY));
$pluginName = strtolower('Contacts');
$pluginSignature = $extensionName.'_'.$pluginName;

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY . '/Configuration/FlexForms/Contacts.xml');

?>