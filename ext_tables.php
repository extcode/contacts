<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Contacts',
	'Contacts'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'contacts');

t3lib_extMgm::addLLrefForTCAdescr('tx_contacts_domain_model_contact', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_contact.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_contacts_domain_model_contact');
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Contact.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_contact.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_contacts_domain_model_company', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_company.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_contacts_domain_model_company');
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Company.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_company.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_contacts_domain_model_address', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_address.xlf');t3lib_extMgm::allowTableOnStandardPages('tx_contacts_domain_model_address');
$TCA['tx_contacts_domain_model_address'] = array(
	'ctrl' => array(
		'title' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address',
		'label' => 'street',
		'label_alt' => 'streetnumber, zip, city, country',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Address.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_address.gif'
	),
);

t3lib_extMgm::addLLrefForTCAdescr('tx_contacts_domain_model_phone', 'EXT:contacts/Resources/Private/Language/locallang_csh_tx_contacts_domain_model_phone.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_contacts_domain_model_phone');
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Phone.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_contacts_domain_model_phone.gif'
	),
);

?>