<?php

declare(strict_types=1);

namespace App\Action\Admin;

use App\Domain\Comment\CommentRepository;
use App\Mapper\CommentMapper;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;

/**
 * create comment savuje
 */
class UpdateComment
{

    public function __construct(Responder $responder, CommentRepository $repo)
    {
        $this->responder = $responder;
        $this->domain = $repo;
    }

    public function __invoke(Request $request, Response $response, array $urlArgs): Response
    {
        $args = $request->getParsedBody();

        if ($args['id'] != $urlArgs['id']) {
            return $this->responder->addError('Tampered data')->withRedirect($response, '/');
        }

        // skontrolovat existenciu clanku
        // budem sa tvarit, ze 1 clanok existuje
        if ($args['article_id'] != 1) {
            $article = $this->domain->findArticleById((int) $args['article_id']);
            // neexistuje clanok s tymto idckom, nafejkoval som to len cez existenciu
            // article_id v tabulke comments
            if (!$article) {
                // neriesim ani dalsie chyby, rovno koncim
                return $this->responder->addError('Clanok neexistuje')->withRedirect($response, '/');
            }
        }

        // skontrolovat existenciu threadu v reakcii
        if ($args['thread_id']) {
            $thread = $this->domain->threadExists((int) $args['thread_id']);
            if (!$thread) {
                // neriesim ani dalsie chyby, rovno koncim
                return $this->responder->addError('Vlakno neexistuje')->withRedirect($response, '/');
            }
        } else {
            // pridava sa novy komentar, takze zistit dalsie thread_id
            $args['thread_id'] = $this->domain->findNextThreadId();
        }

        //author && body
        if (empty($args['author'])) {
            $this->responder->addError('Meno autora je povinne');
        }

        if (empty($args['body']) || strlen($args['body']) < 2) {
            $this->responder->addError('Komentar musi mat aspon 2 znaky');
        }

        if ($this->responder->hasErrors()) {
            return $this->responder->withRedirect($response, '/');
        }

        $comment = CommentMapper::create($args);

        if ($this->domain->update($comment)) {
            $this->responder->addSuccess('Komentar upraveny!');
        } else {
            $this->responder->addWarning('Komentár sa nepodarilo upravit :O');
        }

        return $this->responder->withRedirect($response, '/');
    }
}
