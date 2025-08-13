<?php

declare(strict_types=1);

defined('TYPO3') or die();

if ((new \TYPO3\CMS\Core\Information\Typo3Version())->getMajorVersion() <= 12) {
    $GLOBALS['TYPO3_CONF_VARS']['FE']['addRootLineFields'] .= ',fe_login_mode';
}
