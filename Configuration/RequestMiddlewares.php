<?php

declare(strict_types=1);

use Bo\FeLoginMode\Middleware\TypoScriptFrontendUserMode;

return [
    'frontend' => [
        'bo/fe-login-mode/typoscript-frontend-user-mode' => [
            'target' => TypoScriptFrontendUserMode::class,
            'before' => [
                'typo3/cms-frontend/prepare-tsfe-rendering',
            ],
            'after' => [
                'typo3/cms-frontend/tsfe',
            ],
        ],
    ],
];
