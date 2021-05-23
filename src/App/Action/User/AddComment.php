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
        $this->templatePath = 'comments/add';
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
        var_dump($data);
        if (!$data) {
            return $this->responder->addError(self::COMMENT_MISSING)->withRedirect($response, '/');
        }
        return $this->responder->withTemplate($response, $this->templatePath, $data);
    }
}
