<?php

namespace App\Action\Admin;

use App\Responder\Responder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Session;

final class Logout
{
    /**
     * @var SessionInterface
     */
    private $session;

    public function __construct(Session $session, Responder $responder)
    {
        $this->session = $session;
        $this->responder = $responder;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response
    ): ResponseInterface {
        // Logout user
        $this->session->destroy();
        return $this->responder->addSuccess('Odhlasenie uspesne')->withRedirect($response, '/');
    }
}
