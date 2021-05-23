<?php

declare(strict_types=1);

namespace App\DataType;


class Comment
{
    protected ?int $id = null;
    protected ?string $author = null;
    protected ?string $body = null;
    protected ?int $article_id = null;
    protected ?int $thread_id = null;
    protected ?int $ref_to_comment = null;
    protected ?string $created_at = null;
    protected ?string $updated_at = null;

    public function __construct()
    {
    }

    #magic metody pre get a set
    public function __get(string $key)
    {
        return $this->$key;
    }
    public function __set(string $key, $val)
    {
        $this->$key = $val;
    }
}
