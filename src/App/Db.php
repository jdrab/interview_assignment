<?php

namespace App;

use App\DbConfig;


class Db extends \PDO
{

    public $dbh;

    /**
     * PDO Options
     * @var array
     */
    private $_options;

    /**
     * Query offset
     * @var int
     */
    // public $offset;
    public $statement;
    public $groupBy;
    public $offset;
    public $limit;
    public $columns;
    public $where;
    public $dbTable;

    public function __construct(DbConfig $c)
    {

        die(var_dump($c));
        $this->dbh = parent::__construct(
            $c->adapter() . ':' . $c->host() . ';dbname=' . $c->name(),
            $c->user(),
            $c->pass(),
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $c->charset())
        );
        $this->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
    }

    public static function getInstance()
    {
        // if (!self::$_instance instanceof self) {
        //     self::$_instance = new self;
        // }
        // return self::$_instance;
    }
}
