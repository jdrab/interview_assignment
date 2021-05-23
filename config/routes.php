<?php

use App\Middleware\UserAuthMiddleware;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;


return function (App $app) {

    $app->get('/', \App\Action\ShowArticle::class)->setName('home');
    $app->get('/add-comment/{id}', \App\Action\User\AddComment::class);
    $app->post('/create-comment', \App\Action\User\CreateComment::class);

    #login musi byt mimo /admin
    $app->get('/login', \App\Action\Login::class)->setName('login');
    $app->post('/auth', \App\Action\Admin\Authenticate::class);

    $app->group(
        '/admin',
        function (RouteCollectorProxy $app) {
            $app->get('/logout', \App\Action\Admin\Logout::class);

            $app->get('/add-comment', \App\Action\Admin\AddComment::class);
            $app->post('/create-comment', \App\Action\Admin\CreateComment::class);

            $app->get('/edit-comment/{id}', \App\Action\Admin\EditComment::class);
            $app->post('/update-comment/{id}', \App\Action\Admin\UpdateComment::class);

            $app->get('/delete-comment/{id}', \App\Action\Admin\DeleteComment::class);
            $app->post('/destroy-comment/{id}', \App\Action\Admin\DestroyComment::class);
        }
    )->add(UserAuthMiddleware::class);
};
