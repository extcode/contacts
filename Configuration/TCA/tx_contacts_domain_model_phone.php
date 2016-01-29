<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
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
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('contacts') . 'Resources/Public/Icons/tx_contacts_domain_model_phone.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, number',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, type, number,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
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
				'foreign_table' => 'tx_contacts_domain_model_phone',
				'foreign_table_where' => 'AND tx_contacts_domain_model_phone.pid=###CURRENT_PID### AND tx_contacts_domain_model_phone.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.PREF', 'PREF'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.WORK', 'WORK'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.HOME', 'HOME'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.VOICE', 'VOICE'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.FAX', 'FAX'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.MSG', 'MSG'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.CELL', 'CELL'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.PAGER', 'PAGER'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.BBS', 'BBS'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.MODEM', 'MODEM'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.CAR', 'CAR'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.ISDN', 'ISDN'),
					array('LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.type.VIDEO', 'VIDEO'),
				),
				'size' => 5,
				'maxitems' => 10,
				'eval' => 'required'
			),
		),
		'number' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_phone.number',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
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
