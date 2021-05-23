<?php

declare(strict_types=1);


// https://cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html
#PASSWORD_ARGON2_DEFAULT_MEMORY_COST = 655636
#PASSWORD_ARGON2_DEFAULT_TIME_COST = 4
#PASSWORD_ARGON2_DEFAULT_THREADS = 1

return [
    'default_login' => 'admin',
    'default_password' => 'admin',

    'algo' => PASSWORD_ARGON2ID, // parameter pre password_hash
    'argon2_options' => [
        'memory_cost' => 131072, // 128MB
        'time_cost'   => 4,
        'threads'     => 3,
    ],
    // https://www.php.net/manual/en/session.configuration.php
    'session' => [
        'name' => 'hyperia_zadanie',
        'gc_maxlifetime' => 1800 // seconds eg: 30min
    ]
];
