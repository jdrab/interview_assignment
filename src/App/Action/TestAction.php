<?php

declare(strict_types=1);

namespace App\Action;

use App\Db;
use App\Domain\Comment\CommentRepository;
use App\Domain\TestDomain;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class TestAction
{


    public function __construct(
        CommentRepository $domain,
        Responder $responder
    ) {
        $this->domain = $domain;
        $this->responder = $responder;
    }


    public function __invoke(Request $request, Response $response): Response
    {
        $data = $this->domain->readByPage();
        $data['msg'] = 'Okej vsetko fajn';
        return $this->responder->withTemplate($response, 'test', $data);
    }
}
