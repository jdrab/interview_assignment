<?php

declare(strict_types=1);

use App\Db;
use App\DbConfig;
use App\Middleware\SessionMiddleware;
use App\Responder\Responder;
use App\Session;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Slim\Csrf\Guard;
use Slim\Factory\AppFactory;
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
    'session' => function () {
        return require __DIR__ . '/session.php';
    },

    'csrf' => function (ContainerInterface $container) {
        return new Guard($container->get(App::class)->getResponseFactory());
    },

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
        $responseInterface = $container->get(App::class)->getResponseFactory();
        $engine = $container->get(Templates::class);
        return new Responder($responseInterface, $engine, $container->get('flash'), $container->get('csrf'));
    },

    // slim router - aj pre responder
    RouteParserInterface::class => function (ContainerInterface $container) {
        return $container->get(App::class)->getRouteCollector()->getRouteParser();
    },

    Session::class => function (ContainerInterface $container) {
        $settings = $container->get('session');
        return new Session((array) $settings['session']);
    },

    SessionMiddleware::class => function (ContainerInterface $container) {
        return new SessionMiddleware($container->get(Session::class));
    },

];
