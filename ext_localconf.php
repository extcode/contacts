<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Extcode.' . $_EXTKEY,
	'Contacts',
	array(
		'Contact' => 'list, show, teaser',
	),
	array(
		'Contact' => '',
	)
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Extcode.' . $_EXTKEY,
	'Companies',
	array(
		'Company' => 'list, show, teaser',
	),
	array(
		'Company' => '',
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
