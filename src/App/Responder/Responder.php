<?php

namespace App\Responder;

use Slim\Psr7\Response;
use Slim\Psr7\Factory\ResponseFactory;

use League\Plates\Engine as Templates;

use function http_build_query;

/**
 * A generic responder.
 */
final class Responder
{
    private Templates $templates;


    private ResponseFactory $responseFactory;

    /**
     * The constructor.
     *
     * @param League\Plates\Engine $engine The template engine
     * @param RouteParserInterface $routeParser The route parser
     * @param ResponseFactoryInterface $responseFactory The response factory
     */

    public function __construct(
        Templates $templates,
        ResponseFactory $responseFactory
    ) {
        $this->templates = $templates;
        $this->responseFactory = $responseFactory;
        $this->routeParser = $routeParser;
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

    /**
     * Output rendered template.
     *
     * @param ResponseInterface $response The response
     * @param string $template Template pathname relative to templates directory
     * @param array<mixed> $data Associative array of template variables
     *
     * @return ResponseInterface The response
     */
    public function withTemplate(Response $response, string $template, array $data = []): Response
    {
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
     * @param ResponseInterface $response The response
     * @param string $destination The redirect destination (url or route name)
     * @param array<mixed> $queryParams Optional query string parameters
     *
     * @return ResponseInterface The response
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
     * @param ResponseInterface $response The response
     * @param mixed $data The data
     * @param int $options Json encoding options
     *
     * @return ResponseInterface The response
     */
    public function withJson(
        Response $response,
        $data = null,
        int $options = 0
    ): Response {
        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write((string)json_encode($data, $options));

        return $response;
    }
}
