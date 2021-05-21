<?php

// declare(strict_types=1);

namespace App\Action;

use App\Db;
use App\Domain\TestDomain;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class TestAction
{

    public function __construct(Responder $responder, TestDomain $domain, Db $dbh)
    {
        $this->responder = $responder;
        $this->dbh = $dbh;
        $this->domain = new $domain($this->dbh);
    }

    public function __invoke(
        Request $request,
        Response $response,
    ): Response {
        // die(var_dump(func_get_args()));
        $data = [
            'name' => 'kekeke brekekek'
        ];

        var_dump($this->domain->data());

        return $this->responder->withTemplate($response, 'test', $data);
    }
}
