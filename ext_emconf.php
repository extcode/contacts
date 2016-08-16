<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'contacts',
    'description' => 'Contact extension to replace tt_address',
    'category' => 'plugin',
    'author' => 'Daniel Lorenz',
    'author_email' => 'ext.contacts@extco.de',
    'author_company' => 'extco.de UG (haftungsbeschränkt)',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '0.1.7',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-7.99.99',
            'php' => '5.4.0'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
