<?php

declare(strict_types=1);

namespace App\Action\Admin;

use App\Domain\Comment\CommentRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class DeleteComment
{

    public function __construct(Responder $responder, CommentRepository $commentsRepo)
    {
        $this->responder = $responder;
        $this->repo = $commentsRepo;
    }

    public function __invoke(
        Request $request,
        Response $response
    ): Response {

        $p = (int) $request->getQueryParams()['page'];
        $page = $p > 0 ? $p : 1;

        $data['comments'] = $this->repo->readByPage($page, 10);

        return $this->responder->withTemplate($response, 'admin/delete-comment', $data);
    }
}
