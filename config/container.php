<?php

declare(strict_types=1);

use App\Db;
use App\DbConfig;
use Interface\DbConfigInterface;
use Psr\Container\ContainerInterface;
use Slim\Factory\AppFactory;
use App\Responder\Responder;
use DI\ContainerBuilder;
use League\Plates\Engine;

use Slim\Psr7\Response;
use Slim\Psr7\Factory\ResponseFactory;
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

    // vytvorit rovno appfactory
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer($container);

        return AppFactory::create();
    },

    // DbConfig::class => function (ContainerInterface $container) {
    //     return new DbConfig($container->get('database'));
    // },

    Db::class => function (ContainerInterface $container) {
        return new Db(new DbConfig($container->get('database')));
    },

    Templates::class => function (ContainerInterface $container) {
        return new Engine($container->get('settings')['templates']);
    },

    ResponseFactoryInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getResponseFactory();
    },

    RouteParserInterface::class => function (ContainerInterface $container) {
        return new RouteParserInterface;
    },

    Responder::class => function (ContainerInterface $container) {
        $engine = $container->get(Templates::class);
        $responseInterface = $container->get(App::class)->getResponseFactory();
        return new Responder($engine, $responseInterface);
    },

    // slim router - aj pre  responder
    RouteParserInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getRouteCollector()->getRouteParser();
    },
];
