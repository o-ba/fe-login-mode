<?php

declare(strict_types=1);

use Bo\FeLoginMode\Middleware\TypoScriptFrontendUserMode;
use Bo\FeLoginMode\Middleware\TypoScriptFrontendUserModev13;
use TYPO3\CMS\Core\Information\Typo3Version;

return [
    'frontend' => [
        'bo/fe-login-mode/typoscript-frontend-user-mode' => [
            'target' => (new Typo3Version())->getMajorVersion() === 13 ? TypoScriptFrontendUserModev13::class : TypoScriptFrontendUserMode::class ,
            'before' => [
                'typo3/cms-frontend/shortcut-and-mountpoint-redirect',
            ],
            'after' => [
                'typo3/cms-frontend/prepare-tsfe-rendering'
            ],
        ],
    ],
];
