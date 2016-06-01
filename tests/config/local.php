<?php

/**
 * Local configuration override.
 * Use this to override elements in the config array (combined from main.php and mode_<mode>.php)
 * NOTE: When using a version control system, do NOT commit this file to the repository.
 */
return [
    // Web application configuration.
    'web' => [
        'params' => [
            'local' => true,
        ],
    ],

    // Console application configuration.
    'console' => [
        'params' => [
            'local' => true,
        ],
    ],
];
