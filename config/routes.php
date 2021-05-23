<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Tuupola\Middleware\HttpBasicAuthentication;


return function (App $app) {

    $app->get('/', \App\Action\ShowArticle::class);
    $app->get('/add-comment/{id}', \App\Action\User\AddComment::class);
    $app->post('/create-comment', \App\Action\User\CreateComment::class);

    $app->group(
        '/admin',
        function (RouteCollectorProxy $app) {
            $app->get('/login', \App\Action\Admin\Login::class);
            $app->post('/authenticate', \App\Action\Admin\Authenticate::class);

            $app->get('/logout', \App\Action\Admin\Logout::class);
            $app->post('/terminate', \App\Action\Admin\TerminateSession::class);

            $app->get('/add-comment', \App\Action\Admin\AddComment::class);
            $app->post('/create-comment', \App\Action\Admin\CreateComment::class);

            $app->get('/edit-comment/{id}', \App\Action\Admin\EditComment::class);
            $app->post('/update-comment/{id}', \App\Action\Admin\UpdateComment::class);

            $app->get('/delete-comment/{id}', \App\Action\Admin\DeleteComment::class);
            $app->post('/destroy-comment/{id}', \App\Action\Admin\DestroyComment::class);
        }
    ) // )->add(HttpBasicAuthentication::class);
    ;
};
