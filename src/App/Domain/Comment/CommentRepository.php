<?php

namespace App\Domain\Comment;

use App\Db;
use App\Domain\Comment;
use PDO;

class CommentRepository
{

    public function __construct(Db $db)
    {
        $this->db = $db->connect();
    }

    public function readByPage(
        int $page = 1,
        int $perPage = 10
    ): array {

        $offset = $perPage * ($page - 1);

        $stm = "SELECT * FROM comments LIMIT $perPage OFFSET $offset";
        $sth = $this->db->prepare($stm);
        $sth->execute();

        $rows = $sth->fetchAll(\PDO::FETCH_CLASS, Comment::class);
        return $rows;
    }



    public function insert(Comment $record): bool
    {
        $stm = 'INSERT INTO blog (
            author,
            title,
            intro,
            body
        ) VALUES (
            :author,
            :title,
            :intro,
            :body
        )';

        $sth = $this->pdo->prepare($stm);
        $sth->execute([
            'author' => $record->author,
            'title' => $record->title,
            'intro' => $record->intro,
            'body' => $record->body,
        ]);

        $affected = (bool) $sth->rowCount();
        if ($affected > 0) {
            $record->id = $this->pdo->lastInsertId();
        }

        return $affected;
    }

    // public function update(BlogRecord $record): bool
    // {
    //     $stm = 'UPDATE blog SET
    //         author = :author,
    //         title = :title,
    //         intro = :intro,
    //         body = :body
    //     WHERE id = :id';

    //     $sth = $this->pdo->prepare($stm);
    //     $sth->execute($record->getData());

    //     return (bool) $sth->rowCount();
    // }

}
