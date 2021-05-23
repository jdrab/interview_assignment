<?php

namespace App\Domain\Article;

use App\Db;
use PDO;

class ArticleRepository
{

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    // fakujeme data
    public function findById(int $id): array|bool
    {
        $stmt = $this->db->connect()->prepare("SELECT article_id from comments where article_id = :id ");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
