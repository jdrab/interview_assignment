<?php

declare(strict_types=1);

namespace App\Domain;

use App\Db;

class TestDomain
{

    public function __construct(Db $dbh)
    {
    }

    public function data(): array
    {
        return [];
    }
}
