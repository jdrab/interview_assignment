<?php

declare(strict_types=1);


return [
    # development, testing, production - pre db
    'db' => ['env' => 'development'],

    'errors' => [
        'displayErrorDetails' => true,
        'logErrorDetails' => true,
        'logErrors' => true
    ],
    'templates' => __DIR__ . '/../templates',
];
