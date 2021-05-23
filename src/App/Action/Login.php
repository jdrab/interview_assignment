<?php

declare(strict_types=1);

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class Login
{

    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
        $this->templatePath = 'admin/login';
    }

    public function __invoke(
        Request $request,
        Response $response
    ): Response {

        $data = [];
        $this->responder->preserveMessages($this->responder->getMessages());

        return $this->responder->withTemplate($response, $this->templatePath, $data);
    }
}
