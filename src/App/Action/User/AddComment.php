<?php

declare(strict_types=1);

namespace App\Action\User;

use App\Domain\Comment\CommentRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class AddComment
{
    const COMMENT_INVALID = "Neplatný komentár";
    const COMMENT_MISSING = "Komentár neexistuje";

    public function __construct(Responder $responder, CommentRepository $repo)
    {
        $this->responder = $responder;
        $this->domain = $repo;
        $this->templatePath = 'comment/add-comment';
    }

    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {

        $commentId = (int) $args['id'];

        if ($commentId < 1) {
            return $this->responder->addError(self::COMMENT_INVALID)->withRedirect($response, '/');
        }

        $data = $this->domain->findById($commentId);
        $csrf = $this->responder->csrf;
        $data['nameKey'] = $csrf->getTokenNameKey();
        $data['valueKey'] = $csrf->getTokenValueKey();
        $data['name'] = $request->getAttribute($data['nameKey']);
        $data['value'] = $request->getAttribute($data['valueKey']);

        if (!$data) {
            return $this->responder->addError(self::COMMENT_MISSING)->withRedirect($response, '/');
        }
        return $this->responder->withTemplate($response, $this->templatePath, $data);
    }
}
