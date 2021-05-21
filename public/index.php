<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';


$builder = new DI\ContainerBuilder();

// Add container definitions
$builder->addDefinitions(__DIR__ . '/../config/container.php');

// Build PHP-DI Container instance
$container = $builder->build();

// Create App instance
$app = $container->get(App::class);

// Register routes
(require __DIR__ . '/../config/routes.php')($app);

// Register middleware
(require __DIR__ . '/../config/middleware.php')($app);

$app->run();
