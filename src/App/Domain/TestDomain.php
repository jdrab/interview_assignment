<?php

declare(strict_types=1);

namespace App\Domain;

use App\Db;
use App\DbConfig;

class TestDomain
{

    public function __construct(Db $db)
    {

        var_dump($db);
        $this->db = $db->connect();
        var_dump($this->db);
    }

    public function data(): array
    {
        $stmt = $this->db->prepare("SELECT NOW()");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
