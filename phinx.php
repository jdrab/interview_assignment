<?php

declare(strict_types=1);
# phinx musi pouzivat jednotne nastavenia
$db = require __DIR__ . '/config/database.php';

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
            'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'production' => [
                'adapter' => $db['production']['adapter'],
                'host' => $db['production']['host'],
                'name' => $db['production']['name'],
                'user' => $db['production']['user'],
                'pass' => $db['production']['pass'],
                'port' => $db['production']['port'],
                'charset' => $db['production']['charset'],
            ],
            'development' => [
                'adapter' => $db['development']['adapter'],
                'host' => $db['development']['host'],
                'name' => $db['development']['name'],
                'user' => $db['development']['user'],
                'pass' => $db['development']['pass'],
                'port' => $db['development']['port'],
                'charset' => $db['development']['charset'],
            ],
            'testing' => [
                'adapter' => $db['testing']['adapter'],
                'host' => $db['testing']['host'],
                'name' => $db['testing']['name'],
                'user' => $db['testing']['user'],
                'pass' => $db['testing']['pass'],
                'port' => $db['testing']['port'],
                'charset' => $db['testing']['charset'],
            ]
        ],
        'version_order' => 'creation'
    ];
