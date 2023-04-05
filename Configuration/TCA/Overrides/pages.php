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
                        'label' => 'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.enable',
                        'value' => 0,
                    ],
                    [
                        'label' => 'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.disableAll',
                        'value' => 1,
                    ],
                    [
                        'label' => 'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.disableGroups',
                        'value' => 3,
                    ],
                    [
                        'label' => 'LLL:EXT:fe_login_mode/Resources/Private/Language/locallang.xlf:pages.fe_login_mode.enableAgain',
                        'value' => 2,
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


