<?php

declare(strict_types=1);

use App\Middleware\SessionMiddleware;
use Slim\App;

return function (App $app) {


    // vytiahnut settings container z app
    $settings = $app->getContainer()->get('settings');

    $app->add(SessionMiddleware::class);

    $app->addRoutingMiddleware();

    // a nastavit spravanie pre errory
    $app->addErrorMiddleware(
        $settings['errors']['displayErrorDetails'],
        $settings['errors']['logErrors'],
        $settings['errors']['logErrorDetails']
    );
};
