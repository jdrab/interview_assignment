<?php

declare(strict_types=1);

namespace App\Domain;

use App\Db;
use App\DbConfig;

class TestDomain
{

    public function __construct(Db $pdo)
    {
        $this->pdo = $pdo;
    }

    public function data(): array
    {
        $stmt = $this->pdo->prepare("SELECT NOW()");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
