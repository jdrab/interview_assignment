<?php

namespace App\Action\Admin;

use App\Auth;
use App\Db;
use App\Responder\Responder;
use App\Session;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;

final class Authenticate
{
    public function __construct(
        private Responder $responder,
        private Session $session,
        private Auth $auth,
        private Db $db
    ) {
    }

    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {

        $data = (array)$request->getParsedBody();

        $username = (string)($data['login'] ?? '');
        $password = (string)($data['password'] ?? '');

        if (empty($username) || empty($password)) {
            return $this->responder->addError('Login aj heslo su povinne')->withRedirect($response, '/login');
        }

        // Get RouteParser from request to generate the urls
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();;
        // Login successfully
        if ($this->auth->login($username, $password)) {
            // clear sessin a regenerate
            $this->session->restart();

            $this->session->set('loggedIn', true);
            $this->responder->addSuccess('Prihlasenie uspesne');

            // url nastavit na home cize /
            $url = $routeParser->urlFor('home');
        } else {
            $this->responder->addError('Neúspešné prihlásenie');
            #url na prihlasenie

            $url = $routeParser->urlFor('login');
        }
        $this->responder->preserveMessages($this->responder->getMessages());

        // $this->responder->addSuccess('Komentar pridany!');
        return $response->withStatus(302)->withHeader('Location', $url);
    }
}
