<?php
declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3_MODE') or die();

call_user_func(function () {
    ExtensionManagementUtility::addStaticFile(
        'contacts',
        'Configuration/TypoScript',
        'Contacts'
    );
});
