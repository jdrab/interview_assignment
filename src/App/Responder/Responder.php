<?php

namespace App\Responder;

use function http_build_query;
use League\Plates\Engine as Templates;

use Slim\Csrf\Guard;
use Slim\Flash\Messages;
use Slim\Psr7\Factory\ResponseFactory;
// use Slim\Psr7\Message;
use Slim\Psr7\Response;

/**
 * A generic responder.
 */
final class Responder
{
    private Templates $templates;

    private ResponseFactory $responseFactory;
    private $errors = 0;
    public Guard $csrf;
    public Messages $flash;

    public function __construct(
        ResponseFactory $responseFactory,
        Templates $templates,
        Messages $messages,
        Guard $csrf
    ) {
        $this->templates = $templates;
        $this->responseFactory = $responseFactory;
        $this->flash = $messages;
        $this->csrf = $csrf;
    }

    /**
     * Create a new response.
     *
     * @return Response The response
     */
    public function createResponse(): Response
    {
        return $this->responseFactory->createResponse()->withHeader('Content-Type', 'text/html; charset=utf-8');
    }

    public function getMessages()
    {
        return $this->flash->getMessages();
    }

    public function addError(string $err)
    {
        $this->errors++;
        $this->flash()->addMessage('error', $err);
        $this->templates->addData(['messages' => $err], ["template", "template-clean"]);
        return $this;
    }

    public function addWarning(string $warning)
    {
        $this->flash->addMessage('warning', $warning);
        $this->templates->addData(['messages' => $warning], ["template", "template-clean"]);
        return $this;
    }
    public function addInfo(string $info)
    {
        $this->flash->addMessage('info', $info);
        $this->templates->addData(['messages' => $info], ["template", "template-clean"]);
        return $this;
    }
    public function addSuccess(string $success)
    {
        $this->flash->addMessage('success', $success);
        $this->templates->addData(['messages' => $success], ["template", "template-clean"]);
        return $this;
    }
    public function hasErrors()
    {
        return $this->errors > 0;
    }

    public function flash()
    {
        return $this->flash;
    }

    public function preserveMessages($data)
    {
        $this->templates->addData(['messages' => $data], ["template", "template-clean"]);
    }


    public function addErrors(array $err)
    {
        array_map([Responder::class, 'addError'], $err);
        return $this;
    }

    /**
     * Output rendered template.
     *
     * @param Response $response The response
     * @param string $template Template pathname relative to templates directory
     * @param array<mixed> $data Associative array of template variables
     *
     * @return Response The response
     */
    public function withTemplate(Response $response, string $template, array $data = []): Response
    {
        $this->templates->addData(['errors' => ''], ["template", "template-clean"]);

        $content = $this->templates->render($template, $data);
        $response->getBody()->write($content);
        return $response;
    }

    /**
     * Creates a redirect for the given url / route name.
     *
     * This method prepares the response object to return an HTTP Redirect
     * response to the client.
     *
     * @param Response $response The response
     * @param string $destination The redirect destination (url or route name)
     * @param array<mixed> $queryParams Optional query string parameters
     *
     * @return Response The response
     */
    public function withRedirect(
        Response $response,
        string $destination,
        array $queryParams = []
    ): Response {
        if ($queryParams) {
            $destination = sprintf('%s?%s', $destination, http_build_query($queryParams));
        }

        return $response->withStatus(302)->withHeader('Location', $destination);
    }

    /**
     * Write JSON to the response body.
     *
     * This method prepares the response object to return an HTTP JSON
     * response to the client.
     *
     * @param Response $response The response
     * @param mixed $data The data
     * @param int $options Json encoding options
     *
     * @return Response The response
     */
    public function withJson(
        Response $response,
        $data = null,
        int $options = 0
    ): Response {
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write((string) json_encode($data, $options));

        return $response;
    }
}
