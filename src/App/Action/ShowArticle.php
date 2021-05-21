<?php

declare(strict_types=1);

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

class ShowArticle
{

    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke(
        Request $request,
        Response $response
    ): Response {

        $data = [
            'comments' => [
                [
                    'id' => 1, 'created_at' => '2021-05-20 21:38:52',
                    'updated_at' => '', 'author' => 'Bob Marley',
                    'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Nisi quis eleifend quam adipiscing vitae. Euismod in pellentesque massa placerat duis ultricies lacus sed. Arcu dui vivamus arcu felis bibendum. Ullamcorper malesuada proin libero nunc consequat interdum. '
                ],
                [
                    'id' => 2, 'created_at' => '2021-05-20 21:38:52',
                    'updated_at' => '', 'author' => 'Bob Marley',
                    'body' => 'Senectus et netus et malesuada fames ac turpis. Vel turpis nunc eget lorem dolor sed viverra ipsum nunc. In nibh mauris cursus mattis molestie a iaculis at. Sed sed risus pretium quam vulputate dignissim suspendisse. Mi tempus imperdiet nulla malesuada. Sit amet dictum sit amet justo donec.'
                ],
                [
                    'id' => 3, 'created_at' => '2021-05-20 21:38:52',
                    'updated_at' => '', 'author' => 'Bob Marley',
                    'body' => 'Egestas tellus rutrum tellus pellentesque eu. In dictum non consectetur a erat nam at lectus urna. Lacinia quis vel eros donec ac odio tempor orci. Turpis cursus in hac habitasse platea dictumst quisque sagittis purus. Pellentesque dignissim enim sit amet venenatis urna cursus eget nunc. Vitae congue mauris rhoncus aenean vel.'
                ],
            ]
        ];
        return $this->responder->withTemplate($response, 'article', $data);
    }
}
