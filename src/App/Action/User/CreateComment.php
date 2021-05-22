<?php

declare(strict_types=1);

namespace App\Action\User;

use App\DataTypes\FlashMessage;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;


/**
 * create comment savuje
 */
class CreateComment
{

    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        // $this->respondeget('flash')->addMessage('Test', 'This is a message');
        // Redirect
        // return $res->withStatus(302)->withHeader('Location', '/bar');

        #$data = $request->getParsedBody();
        #$data = $this->repo->insert();


        return $this->responder //->addErrors(["prva", "druha"])
            ->addWarning('Toto je varowanie')
            ->addInfo('Si sa pozral..')
            ->addSuccess('Si pan si pan')
            ->addError('tretia chyba')->withRedirect($response, '/');
    }

    // return $this->responder->withTemplate($response, $this->templatePath, $data);
    // }
}
