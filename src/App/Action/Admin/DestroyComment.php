<?php

declare(strict_types=1);

namespace App\Action\Admin;

use App\DataType\FlashMessage;
use App\Db;
use App\DbConfig;
use App\DataType\Comment;
use App\Domain\Comment\CommentRepository;
use App\Mapper\CommentMapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

/**
 * create comment savuje
 */
class DestroyComment
{

    public function __construct(Responder $responder, CommentRepository $repo)
    {
        $this->responder = $responder;
        $this->domain = $repo;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        //zmazat komentar samotny ale aj komentare, ktore nan odkazuju
        $commentId = (int) $args['id'];
        // najst komentar
        if (!$this->domain->findById($commentId)) {
            return $this->responder->addError("Komentar neexistuje")->withRedirect($response, '/');
        }

        if ($this->domain->delete($commentId)) {
            $this->responder->addSuccess("Komentar zmazany");
        } else {
            $this->responder->addError("Komentar sa nepodarilo zmazat");
        }
        return $this->responder->withRedirect($response, '/');
    }
}
