<?php

declare(strict_types=1);

namespace App\Action\Admin;

use App\Domain\Comment\CommentRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class DeleteComment
{

    public function __construct(Responder $responder, CommentRepository $repo)
    {
        $this->responder = $responder;
        $this->domain = $repo;
    }

    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        // Fetch parameters from the request
        $commentId = (int) $args['id'];
        if ($commentId < 1) {
            return $this->responder->addError('Neplatné ID komentára')->withRedirect($response, '/');
        }

        $data = $this->domain->findById($commentId);

        if (!$data) {
            return $this->responder->addError('Komentar neexistuje')->withRedirect($response, '/');
        }
        return $this->responder->withTemplate($response, 'admin/comment/delete-comment', $data);
    }
}


// ZMAZANIE KOMENTARA KTORY JE'asdf' v url FIXNUT
