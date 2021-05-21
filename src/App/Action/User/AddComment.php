<?php

declare(strict_types=1);

namespace App\Action\User;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class AddComment
{

    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
        $this->templatePath = 'comments/add';
    }

    public function __invoke(
        Request $request,
        Response $response
    ): Response {

        $data = [];

        return $this->responder->withTemplate($response, $this->templatePath, $data);
    }
}
