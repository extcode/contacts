<?php

defined('TYPO3_MODE') or die();

$_LLL_core_general = 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf';
$_LLL_db = 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf';
$_LLL_tca = 'LLL:EXT:contacts/Resources/Private/Language/locallang_tca.xlf';

return [
    'ctrl' => [
        'title' => $_LLL_db . ':tx_contacts_domain_model_contact',
        'label' => 'first_name',
        'label_alt' => 'last_name',
        'label_alt_force' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'versioningWS' => true,
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
        'searchFields' => 'first_name,last_name,addresses,',
        'iconfile' => 'EXT:contacts/Resources/Public/Icons/tx_contacts_domain_model_contact.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, fe_user, photo, salutation, title, first_name, last_name, birthday, email, uri, companies, addresses, phone_numbers,tt_content',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                fe_user,
                photo,
                salutation, title, first_name, last_name,
                birthday,
                email, uri,
                companies,
                addresses,
                phone_numbers,
                tt_content,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
                    --palette--;' . $_LLL_tca . ':palettes.visibility;hiddenonly,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access,
            '
        ],
    ],
    'palettes' => [
        'hiddenonly' => [
            'showitem' => 'hidden;' . $_LLL_db . ':tx_contacts_domain_model_contact',
        ],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel, endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ],
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_contacts_domain_model_contact',
                'foreign_table_where' => 'AND tx_contacts_domain_model_contact.pid=###CURRENT_PID### AND tx_contacts_domain_model_contact.sys_language_uid IN (-1,0)',
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
            'label' => $_LLL_core_general . ':LGL.hidden',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0'
                    ]
                ]
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
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
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
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
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.fe_user',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'readOnly' => 0,
                'foreign_table' => 'fe_users',
                'size' => 1,
                'items' => [
                    ['', 0],
                ],
                'minitems' => 0,
                'maxitems' => 1,
                'eval' => 'int',
                'default' => 0,
            ]
        ],

        'salutation' => [
            'exclude' => 0,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.salutation',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'title' => [
            'exclude' => 0,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'first_name' => [
            'exclude' => 0,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.first_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'last_name' => [
            'exclude' => 0,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.last_name',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'birthday' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.birthday',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 13,
                'eval' => 'date',
                'checkbox' => 1,
                'default' => 0
            ],
        ],
        'companies' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.companies',
            'config' => [
                'type' => 'group',
                'internal_type' => 'db',
                'foreign_table' => 'tx_contacts_domain_model_company',
                'allowed' => 'tx_contacts_domain_model_company',
                'MM' => 'tx_contacts_domain_model_contact_company_mm',
                'MM_opposite_field' => 'contact',
                'maxitems' => 9999,
                'fieldControl' => [
                    'addRecord' => [
                        'disabled' => false,
                        'renderType' => 'addRecord',
                        'options' => [
                            'title' => 'Definiere ',
                            'setValue' => 'append',
                            'pid' => '###CURRENT_PID###',
                        ],
                    ],
                ],
            ],
        ],
        'addresses' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.addresses',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_contacts_domain_model_address',
                'foreign_field' => 'contact',
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
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.phone_numbers',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_contacts_domain_model_phone',
                'foreign_field' => 'contact',
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
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.email',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'uri' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.uri',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputLink',
                'size' => 30,
                'max' => 256,
                'eval' => 'trim',
                'wizards' => [
                    '_PADDING' => 2,
                    'link' => [
                        'type' => 'popup',
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:header_link_formlabel',
                        'icon' => 'actions-wizard-link',
                        'module' => [
                            'name' => 'wizard_link',
                            'urlParameters' => [
                                'mode' => 'wizard'
                            ]
                        ],
                        'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1',
                        'params'   => [
                            'blindLinkOptions' => 'mail,folder'
                        ]
                    ]
                ],
                'softref' => 'typolink'
            ],
        ],
        'photo' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.photo',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'Photo',
                ['maxitems' => 1],
                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
            ),
        ],
        'tt_content' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_contacts_domain_model_contact.tt_content',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'tx_contacts_domain_model_contact',
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
            ]
        ],
    ],
];
