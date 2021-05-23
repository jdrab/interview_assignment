<?php

declare(strict_types=1);

namespace App\Domain\Comment;

use App\Db;
use App\Domain\Article\ArticleRepository;
use App\DataType\Comment;
use PDO;

class CommentRepository
{

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    public function findArticleById(int $id): array|bool
    {
        return (new ArticleRepository($this->db))->findById($id);
    }

    public function threadExists(int $id): bool
    {
        $q = "SELECT EXISTS( SELECT 1 from comments where thread_id = :id limit 1)";
        $stmt = $this->db->connect()->prepare($q);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return (bool) $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findById(int $id)
    {

        $q = "SELECT * from comments where id = :id";
        $stmt = $this->db->connect()->prepare($q);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function readByPage(
        int $page = 1,
        int $perPage = 20
    ): array {

        $offset = $perPage * ($page - 1);


        $q = "SELECT * FROM comments order by thread_id,created_at LIMIT :limit OFFSET :offset ";
        $stmt = $this->db->connect()->prepare($q);
        $stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();

        $rows = $stmt->fetchAll(\PDO::FETCH_CLASS, Comment::class);
        return $rows;
    }
    public function findNextThreadId(): int
    {
        $stmt = $this->db->connect()->query("SELECT MAX(thread_id) AS tid from comments");
        # pretoze MAX moze vratit aj NULL a mysql nezvlada null+1 :P
        return 1 + $stmt->fetch(\PDO::FETCH_ASSOC)['tid'];
    }

    public function insert(Comment $comment): bool
    {

        $q = "INSERT INTO comments (author,body,article_id,thread_id,ref_to_comment_id)
        VALUES (
        :author,
        :body,
        :article_id,
        :thread_id,
        :ref_to_comment_id)";
        $stmt = $this->db->connect()->prepare($q);
        $stmt->execute(
            [
                'author' => filter_var($comment->author, FILTER_SANITIZE_STRING),
                'body' => filter_var($comment->body, FILTER_SANITIZE_STRING),
                'article_id' => $comment->article_id,
                'thread_id' => $comment->thread_id,
                'ref_to_comment_id' => $comment->ref_to_comment_id
            ]
        );
        # len pri sqlite vzdy vracia rowCount() z pdo 0
        return (bool) $stmt->rowCount();
    }


    public function delete(int $comment_id): bool
    {
        $q = "DELETE FROM comments where id = :id OR ref_to_comment_id = :id";
        $stmt = $this->db->connect()->prepare($q);
        $stmt->bindParam(':id', $comment_id, PDO::PARAM_INT);
        $stmt->execute();
        return ($stmt->rowCount() > 0);
    }

    public function update(Comment $comment): bool
    {
        # v db sa updated_at column meni lebo ON UPDATE current_timestamp()
        $q = "UPDATE comments SET author=:author ,body =:body WHERE id = :id";
        $stmt = $this->db->connect()->prepare($q);
        $stmt->execute(
            [
                'author' => filter_var($comment->author, FILTER_SANITIZE_STRING),
                'body' => filter_var($comment->body, FILTER_SANITIZE_STRING),
                'id' => filter_var($comment->id, FILTER_SANITIZE_NUMBER_INT),
            ]
        );
        # len pri sqlite vzdy vracia rowCount() z pdo 0
        return (bool) $stmt->rowCount();
    }
}
