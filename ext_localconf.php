<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addPageTSConfig(
    'mod.web_info.fieldDefinitions.2.fields := addToList(fe_login_mode)'
);

$GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',fe_login_mode';
