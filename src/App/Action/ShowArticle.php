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
    private $perPage = 50;

    # za normalnych okolnosti by tu bol article repository a ten by hladal commenty,
    # ale article repo neexistuje, rovnako je to obratene nafejkovane v comments repo
    # ked hlada articles by id..
    public function __construct(Responder $responder, CommentRepository $comment)
    {
        $this->responder = $responder;
        $this->comment = $comment;
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

        $csrf = $this->responder->csrf;
        $data['nameKey'] = $csrf->getTokenNameKey();
        $data['valueKey'] = $csrf->getTokenValueKey();
        $data['name'] = $request->getAttribute($data['nameKey']);
        $data['value'] = $request->getAttribute($data['valueKey']);

        $data['comments'] = $this->comment->readByPage($this->page, $this->perPage);
        // preserve messages
        $this->responder->preserveMessages($this->responder->getMessages());

        return $this->responder->withTemplate($response, 'article', $data);
    }
}
