<?php

namespace App\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use App\Session;

final class SessionMiddleware implements MiddlewareInterface
{

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Invoke middleware.
     *
     * @param ServerRequestInterface $request The request
     * @param RequestHandlerInterface $handler The handler
     *
     * @return ResponseInterface The response
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // _DISABLED = 0
        // _NONE = 1
        // _ACTIVE = 2
        // die(var_dump(session_status()));
        if (!$this->session->isActive()) {
            $this->session->start();
        }

        $response = $handler->handle($request);
        // $this->session->save();

        return $response;
    }
}
