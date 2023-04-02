<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

session_start();

$builder = new DI\ContainerBuilder();

$builder->addDefinitions(__DIR__ . '/../config/container.php');
$container = $builder->build();
$app = $container->get(App::class);

(require __DIR__ . '/../config/routes.php')($app);
(require __DIR__ . '/../config/middleware.php')($app);

$app->run();
