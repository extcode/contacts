<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
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

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Extcode.' . $_EXTKEY,
	'Address',
	array(
		'Address' => 'show',

	),
	array(
	)
);
