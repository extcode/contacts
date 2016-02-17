<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => $_LLL . ':tx_contacts_domain_model_phone',
        'label' => 'number',
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
        'iconfile' => 'EXT:contacts/Resources/Public/Icons/Order/tx_contacts_domain_model_phone.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, number',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, type, number,--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'],
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
                'foreign_table' => 'tx_contact_domain_model_phone',
                'foreign_table_where' => 'AND tx_contact_domain_model_phone.pid=###CURRENT_PID### AND tx_contact_domain_model_phone.sys_language_uid IN (-1,0)',
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
        'type' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_phone.type',
            'config' => [
                'type' => 'select',
                'items' => [
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.PREF',
                        'PREF'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.WORK',
                        'WORK'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.HOME',
                        'HOME'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.VOICE',
                        'VOICE'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.FAX',
                        'FAX'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.MSG',
                        'MSG'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.CELL',
                        'CELL'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.PAGER',
                        'PAGER'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.BBS',
                        'BBS'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.MODEM',
                        'MODEM'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.CAR',
                        'CAR'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.ISDN',
                        'ISDN'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_phone.type.VIDEO',
                        'VIDEO'
                    ],
                ],
                'size' => 5,
                'maxitems' => 10,
                'eval' => 'required'
            ],
        ],
        'number' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_phone.number',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required'
            ],
        ],
        'contact' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'company' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
