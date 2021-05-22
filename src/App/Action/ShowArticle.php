<?php

declare(strict_types=1);

namespace App\Action;

use App\Domain\Comment\CommentRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class ShowArticle
{
    private $repo;
    private $responder;
    private $page = 1;
    private $perPage = 10;

    public function __construct(Responder $responder, CommentRepository $repo)
    {
        $this->responder = $responder;
        $this->repo = $repo;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        // @TODO moznost menit perPage podla requestu
        if (
            !empty($request->getQueryParams()['page']) &&
            (int) $request->getQueryParams()['page'] > 0
        ) {
            $this->page = (int) $request->getQueryParams()['page'];
        }

        $data['comments'] = $this->repo->readByPage($this->page, $this->perPage);
        // preserve messages
        $this->responder->preserveMessages($this->responder->getMessages());

        return $this->responder->withTemplate($response, 'article', $data);
    }
}
