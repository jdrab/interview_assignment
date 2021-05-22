<?php

declare(strict_types=1);

use App\Db;
use App\DbConfig;
use App\Responder\Responder;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
//copy pasta
use Slim\Interfaces\RouteParserInterface;

return [
    // natiahnut do kontaniera settings
    'settings' => function () {
        return require __DIR__ . '/settings.php';
    },
    'database' => function () {
        return require __DIR__ . '/database.php';
    },
    'flash' => function () {
        return new \Slim\Flash\Messages();
    },

    // vytvorit rovno appfactory
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    DbConfig::class => function (ContainerInterface $container) {
        $settings = $container->get('settings');
        $dbconfig = $container->get('database');

        return new DbConfig($dbconfig[$settings['db']['env']]);
    },

    Db::class => function (ContainerInterface $container) {
        $settings = $container->get('settings');
        $dbconfig = $container->get('database');

        return new Db(new DbConfig($dbconfig[$settings['db']['env']]));
    },

    Templates::class => function (ContainerInterface $container) {
        return new Engine($container->get('settings')['templates']);
    },

    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },

    Responder::class => function (ContainerInterface $container) {
        $engine = $container->get(Templates::class);
        $responseInterface = $container->get(App::class)->getResponseFactory();
        return new Responder($engine, $responseInterface, $container->get('flash'));
    },

    // slim router - aj pre responder,take divne
    RouteParserInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getRouteCollector()->getRouteParser();
    },
];
