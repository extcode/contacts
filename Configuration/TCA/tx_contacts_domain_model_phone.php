<?php

defined('TYPO3_MODE') or die();

$_LLL_core_general = 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf';
$_LLL_db = 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf';
$_LLL_tca = 'LLL:EXT:contacts/Resources/Private/Language/locallang_tca.xlf';

return [
    'ctrl' => [
        'title' => $_LLL_db . ':tx_contacts_domain_model_phone',
        'label' => 'number',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',

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
        'searchFields' => 'street,zip,city',
        'iconfile' => 'EXT:contacts/Resources/Public/Icons/tx_contacts_domain_model_phone.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                type,
                number,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
                    --palette--;' . $_LLL_tca . ':palettes.visibility;hiddenonly,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access,
            '
        ],
    ],
    'palettes' => [
        'hiddenonly' => [
            'showitem' => 'hidden;' . $_LLL_db . ':tx_contacts_domain_model_phone',
        ],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel, endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items' => [
                    ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.default_value', 0]
                ],
                'eval' => 'int',
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_contacts_domain_model_phone',
                'foreign_table_where' => 'AND tx_contacts_domain_model_phone.pid=###CURRENT_PID### AND tx_contacts_domain_model_phone.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
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
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
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
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
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
        'type' => [
            'exclude' => 0,
            'label' => $_LLL_db . ':tx_contacts_domain_model_phone.type',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.PREF',
                        'PREF'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.WORK',
                        'WORK'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.HOME',
                        'HOME'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.VOICE',
                        'VOICE'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.FAX',
                        'FAX'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.MSG',
                        'MSG'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.CELL',
                        'CELL'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.PAGER',
                        'PAGER'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.BBS',
                        'BBS'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.MODEM',
                        'MODEM'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.CAR',
                        'CAR'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.ISDN',
                        'ISDN'
                    ],
                    [
                        $_LLL_db . ':tx_contacts_domain_model_phone.type.VIDEO',
                        'VIDEO'
                    ],
                ],
                'size' => 5,
                'minitems' => 1,
                'maxitems' => 10,
            ],
        ],
        'number' => [
            'exclude' => 0,
            'label' => $_LLL_db . ':tx_contacts_domain_model_phone.number',
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
