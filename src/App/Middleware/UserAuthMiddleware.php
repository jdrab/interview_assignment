<?php

namespace App\Middleware;

use App\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Factory\ResponseFactory;
use Slim\Routing\RouteContext;

final class UserAuthMiddleware implements MiddlewareInterface
{
    public function __construct(
        private ResponseFactory $responseFactory,
        private Session $session
    ) {
        $this->responseFactory = $responseFactory;
        $this->session = $session;
    }

    public function process(
        ServerRequestInterface $request,
        RequestHandlerInterface $handler
    ): ResponseInterface {
        if ($this->session->get('loggedIn')) {
            // User is logged in
            return $handler->handle($request);
        }

        // User is not logged in. Redirect to login page.
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('login');

        return $this->responseFactory->createResponse()
            ->withStatus(302)
            ->withHeader('Location', $url);
    }
}
