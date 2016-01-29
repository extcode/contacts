<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

return array(
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
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('contacts') . 'Resources/Public/Icons/tx_contacts_domain_model_company.png'
	),
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, logo, name, email, uri, companies, contacts, addresses, phone_numbers, tt_content',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1,
			logo, name, email, uri, companies, contacts, addresses, phone_numbers,
			tt_content,
			--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_contacts_domain_model_company',
				'foreign_table_where' => 'AND tx_contacts_domain_model_company.pid=###CURRENT_PID### AND tx_contacts_domain_model_company.sys_language_uid IN (-1,0)',
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
		'name' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xml:tx_contacts_domain_model_company.name',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'contacts' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.contacts',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'foreign_table' => 'tx_contacts_domain_model_contact',
				'allowed' => 'tx_contacts_domain_model_contact',
				'MM' => 'tx_contacts_domain_model_contact_company_mm',
				'maxitems' => 9999,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
					),
					'add' => array(
						'type' => 'script',
						'title' => 'LLL:EXT:cms/locallang_tca.xlf:sys_template.basedOn_add',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_contacts_domain_model_contact',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'module' => array(
							'name' => 'wizard_add'
						)
					)
				),
			),
		),
		'companies' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.companies',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'db',
				'foreign_table' => 'tx_contacts_domain_model_company',
				'allowed' => 'tx_contacts_domain_model_company',
				'MM' => 'tx_contacts_domain_model_company_company_mm',
				'maxitems' => 9999,
				'wizards' => array(
					'suggest' => array(
						'type' => 'suggest',
					),
				),
				'add' => array(
					'type' => 'script',
					'title' => 'LLL:EXT:cms/locallang_tca.xlf:sys_template.basedOn_add',
					'icon' => 'add.gif',
					'params' => array(
						'table' => 'tx_contacts_domain_model_company',
						'pid' => '###CURRENT_PID###',
						'setValue' => 'prepend'
					),
					'module' => array(
						'name' => 'wizard_add'
					)
				)
			),
		),
		'addresses' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.addresses',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_contacts_domain_model_address',
				'foreign_field' => 'company',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'phone_numbers' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.phone_numbers',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_contacts_domain_model_phone',
				'foreign_field' => 'company',
				'maxitems'      => 9999,
				'appearance' => array(
					'collapseAll' => 1,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'email' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.email',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'uri' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.uri',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
		'logo' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.logo',
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
					'Logo',
					array('maxitems' => 1),
					$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
				),
		),
		'tt_content' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_company.tt_content',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tt_content',
				'foreign_field' => 'tx_contacts_domain_model_company',
				'foreign_sortby' => 'sorting',
				'minitems' => 0,
				'maxitems' => 99,
				'appearance' => array(
					'levelLinksPosition' => 'top',
					'showPossibleLocalizationRecords' => TRUE,
					'showRemovedLocalizationRecords' => TRUE,
					'showAllLocalizationLink' => TRUE,
					'showSynchronizationLink' => TRUE,
					'enabledControls' => array(
						'info' => TRUE,
						'new' => FALSE,
						'dragdrop' => FALSE,
						'sort' => FALSE,
						'hide' => TRUE,
						'delete' => TRUE,
						'localize' => TRUE,
					)
				),
				'inline' => array(
					'inlineNewButtonStyle' => 'display: inline-block;',
				),
				'behaviour' => array(
					'localizationMode' => 'select',
					'localizeChildrenAtParentLocalization' => TRUE,
				),
			)
		),
	),
);
