<?php

declare(strict_types=1);

use Slim\App;
use Slim\Views\TwigMiddleware;

return function (App $app) {

    // vytiahnut settings container z app
    $settings = $app->getContainer()->get('settings');

    $app->addRoutingMiddleware();

    // a nastavit spravanie pre errory
    $app->addErrorMiddleware(
        $settings['errors']['displayErrorDetails'],
        $settings['errors']['logErrors'],
        $settings['errors']['logErrorDetails']
    );
};
