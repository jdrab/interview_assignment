<?php

namespace App;

use PDO;

use App\DbConfig;


class Db extends \PDO
{

    protected $dbh;

    public function __construct(DbConfig $c)
    {
        try {
            $this->dbh = new \PDO(
                $c->adapter() . ':host=' . $c->host() . ';port=' . $c->port() . ';dbname=' . $c->name(),
                $c->user(),
                $c->pass(),
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
                ]
            );
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function connect(): PDO
    {
        return $this->dbh;
    }
}
