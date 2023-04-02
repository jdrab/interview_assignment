<?php

namespace App\Action\Admin;

use App\Responder\Responder;
use App\Session;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class Logout
{

    public function __construct(private Responder $responder, private Session $session)
    {
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
