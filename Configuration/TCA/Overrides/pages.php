<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

ExtensionManagementUtility::addTCAcolumns(
    'pages',
    [
        'fe_login_mode' => [
            'exclude' => true,
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    [
                        'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.enable',
                        0,
                    ],
                    [
                        'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.disableAll',
                        1,
                    ],
                    [
                        'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.disableGroups',
                        3,
                    ],
                    [
                        'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.enableAgain',
                        2,
                    ],
                ],
            ],
        ],
    ]
);

ExtensionManagementUtility::addFieldsToPalette(
    'pages',
    'access',
    '--linebreak--,fe_login_mode;LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode_formlabel',
    'after:fe_group'
);


