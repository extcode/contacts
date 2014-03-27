<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_contacts_domain_model_address'] = array(
	'ctrl' => $TCA['tx_contacts_domain_model_address']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, street, street_number, zip, city, region, country, post_box, lon, lat',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,
		type,
		street, street_number, zip, city, region, country, post_box,
		--palette--;LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.lon_lat;lon_lat,
		--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
		'lon_lat' => array('showitem' => 'lon, lat', 'canNotCollapse' => 1),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_contacts_domain_model_address',
				'foreign_table_where' => 'AND tx_contacts_domain_model_address.pid=###CURRENT_PID### AND tx_contacts_domain_model_address.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_address.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_address.type.DOM', 'DOM'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_address.type.INTL', 'INTL'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_address.type.POSTAL', 'POSTAL'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_address.type.PARCEL', 'PARCEL'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_address.type.HOME', 'HOME'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_address.type.WORK', 'WORK'),
				),
				'size' => 5,
				'maxitems' => 10,
				'eval' => 'required'
			),
		),
		'street' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.street',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'street_number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.street_number',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'zip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.zip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'region' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.region',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'country' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.country',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'lon' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.lon',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'lat' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.lat',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'post_box' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.post_box',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'contact' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		'company' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
	),
);
