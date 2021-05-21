<?php

declare(strict_types=1);

use App\Domain\Example\Service\MyService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


namespace App\Action;

final class ExampleAction
{
    /**
     * @var MyService
     */
    private $myService;

    /**
     * @var Responder
     */
    private $responder;

    public function __construct(MyService $myService, Responder $responder)
    {
        $this->myService = $myService;
        $this->responder = $responder;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        // 1. collect input from the HTTP request (if needed)
        $data = (array)$request->getParsedBody();

        // 2. Invokes the Domain (Application-Service)
        // with those inputs (if required) and retains the result
        // $domainResult = $this->myService->doSomething($data);
        $domainResults = ['id' => '1', 'string' => 'hello world'];
        // 3. Build and return a HTTP response
        return $this->responder->withJson($domainResults);
    }
}
