<?php

// declare(strict_types=1);

namespace App\Domain\Repository\CommentRepository;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Responder\Responder;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use PDO;

class CommentRepository
{

    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }

    public function __invoke()
    {

        $data = [
            'time' => new DateTime(DateTimeInterface::ISO8601)
        ];
        return $data;
    }
}
