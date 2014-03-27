<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


Tx_Extbase_Utility_Extension::configurePlugin(
	'Extcode.' . $_EXTKEY,
	'Contacts',
	array(
		'Contact' => 'list, show',

	),
	// non-cacheable actions
	array(
		'Contact' => '',
		'Address' => '',

	)
);
