<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => $_LLL . ':tx_contacts_domain_model_address',
        'label' => 'street',
        'label_alt' => 'street_number, zip, city, country',
        'label_alt_force' => 1,
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
        'iconfile' => 'EXT:contacts/Resources/Public/Icons/tx_contacts_domain_model_address.png',
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, type, street, street_number, addition1, addition2, zip, city, region, country, post_box, lon, lat, tt_content',
    ],
    'types' => [
        '1' => [
            'showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, type, --palette--;' . $_LLL . ':tx_contacts_domain_model_company.palette.address;address, post_box, tt_content, --palette--;LLL:EXT:contacts/Resources/Private/Language/locallang_db.xlf:tx_contacts_domain_model_address.lon_lat;lon_lat, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access,starttime, endtime'
        ],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
        'address' => ['showitem' => 'street, street_number, --linebreak--, addition1, addition2, --linebreak--, zip, city, --linebreak--, region, country', 'canNotCollapse' => 1],
        'lon_lat' => ['showitem' => 'lat, lon', 'canNotCollapse' => 1],
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
                'foreign_table' => 'tx_contacts_domain_model_address',
                'foreign_table_where' => 'AND tx_contacts_domain_model_address.pid=###CURRENT_PID### AND tx_contacts_domain_model_address.sys_language_uid IN (-1,0)',
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
        'title' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'type' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.type',
            'config' => [
                'type' => 'select',
                'items' => [
                    [
                        $_LLL . ':tx_contacts_domain_model_address.type.DOM',
                        'DOM'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_address.type.INTL',
                        'INTL'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_address.type.POSTAL',
                        'POSTAL'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_address.type.PARCEL',
                        'PARCEL'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_address.type.HOME',
                        'HOME'
                    ],
                    [
                        $_LLL . ':tx_contacts_domain_model_address.type.WORK',
                        'WORK'
                    ],
                ],
                'size' => 5,
                'minitems' => 1,
                'maxitems' => 10,
            ],
        ],
        'street' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.street',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'street_number' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.street_number',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'addition1' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.addition1',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'addition2' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.addition2',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'zip' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.zip',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'city' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_contacts_domain_model_address.city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'region' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_address.region',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'country' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_address.country',
            'config' => [
                'type' => 'select',
                'foreign_table' => 'tx_contacts_domain_model_country',
                'maxitems' => 1,
                'appearance' => [
                    'collapseAll' => 1,
                    'expandSingle' => 1,
                ],
            ],
        ],
        'lat' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_address.lat',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'lon' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_address.lon',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'post_box' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_address.post_box',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
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
        'tt_content' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_contacts_domain_model_address.tt_content',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tt_content',
                'foreign_field' => 'tx_contacts_domain_model_address',
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
