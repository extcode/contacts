<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => $_LLL . ':tx_contacts_domain_model_company',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'versioningWS' => 2,
        'versioning_followPages' => true,
        'origUid' => 't3_origuid',
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'street,zip,city',
        'iconfile' => 'EXT:contacts/Resources/Public/Icons/tx_contacts_domain_model_company.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, fe_user, logo, name, email, uri, companies, contacts, addresses, phone_numbers, tt_content',
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, fe_user, logo, name, email, uri, companies, contacts, addresses, phone_numbers, tt_content, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'
        ],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_contacts_domain_model_company',
                'foreign_table_where' => 'AND tx_contacts_domain_model_company.pid=###CURRENT_PID### AND tx_contacts_domain_model_company.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],

        'fe_user' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.fe_user',
            'config' => [
                'type' => 'select',
                'readOnly' => 0,
                'foreign_table' => 'fe_users',
                'size' => 1,
                'autoMaxSize' => 1,
                'items' => [
                    [$_LLL . ':tx_contacts_domain_model_company.fe_user.not_available', 0],
                ],
                'minitems' => 0,
                'maxitems' => 1,
                'multiple' => 0,
            ]
        ],

        'name' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_company.name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'contacts' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.contacts',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_contacts_domain_model_contact',
                'allowed' => 'tx_contacts_domain_model_contact',
                'MM' => 'tx_contacts_domain_model_contact_company_mm',
                'maxitems' => 9999,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                    ],
                    'add' => [
                        'type' => 'script',
                        'title' => 'LLL:EXT:cms/locallang_tca.xlf:sys_template.basedOn_add',
                        'icon' => 'add.gif',
                        'params' => [
                            'table' => 'tx_contacts_domain_model_contact',
                            'pid' => '###CURRENT_PID###',
                            'setValue' => 'prepend'
                        ],
                        'module' => [
                            'name' => 'wizard_add'
                        ]
                    ]
                ],
            ],
        ],
        'companies' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.companies',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_contacts_domain_model_company',
                'allowed' => 'tx_contacts_domain_model_company',
                'MM' => 'tx_contacts_domain_model_company_company_mm',
                'maxitems' => 9999,
                'wizards' => [
                    'suggest' => [
                        'type' => 'suggest',
                    ],
                ],
                'add' => [
                    'type' => 'script',
                    'title' => 'LLL:EXT:cms/locallang_tca.xlf:sys_template.basedOn_add',
                    'icon' => 'add.gif',
                    'params' => [
                        'table' => 'tx_contacts_domain_model_company',
                        'pid' => '###CURRENT_PID###',
                        'setValue' => 'prepend'
                    ],
                    'module' => [
                        'name' => 'wizard_add'
                    ]
                ]
            ],
        ],
        'addresses' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.addresses',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_contacts_domain_model_address',
                'foreign_field' => 'company',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'phone_numbers' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.phone_numbers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_contacts_domain_model_phone',
                'foreign_field' => 'company',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'email' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'uri' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.uri',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'logo' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.logo',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'Logo',
                ['maxitems' => 1],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'tt_content' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_company.tt_content',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'tx_contacts_domain_model_company',
                'foreign_sortby' => 'sorting',
                'minitems' => 0,
                'maxitems' => 99,
                'appearance' => [
                    'levelLinksPosition' => 'top',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                    'enabledControls' => [
                        'info' => true,
                        'new' => true,
                        'dragdrop' => false,
                        'sort' => true,
                        'hide' => true,
                        'delete' => true,
                        'localize' => true,
                    ]
                ],
                'inline' => [
                    'inlineNewButtonStyle' => 'display: inline-block;',
                ],
                'behaviour' => [
                    'localizationMode' => 'select',
                    'localizeChildrenAtParentLocalization' => true,
                ],
            ]
        ],
    ],
];
