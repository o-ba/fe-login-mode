<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Frontend user login mode',
    'description' => 'Provides the frontend user login mode functionality for TYPO3',
    'category' => 'fe',
    'author' => 'Oliver Bartsch',
    'author_email' => 'bo@cedev.de',
    'clearCacheOnLoad' => true,
    'state' => 'stable',
    'version' => '1.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '12.0.0-13.4.99',
        ],
        'conflicts' => [],
        'suggests' => []
    ],
    'autoload' => [
        'psr-4' => [
            'Bo\\FeLoginMode\\' => 'Classes/',
        ],
    ],
];
