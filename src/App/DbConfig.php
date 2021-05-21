<?php

declare(strict_types=1);

namespace App;

use Interface\DbConfigInterface;

class DbConfig implements DbConfigInterface
{
    public function __invoke($config): DbConfigInterface
    {
        $this->adapter = $config['adapter'] ?? null;
        $this->host = $config['host'] ?? null;
        $this->name = $config['name'] ?? null;
        $this->user = $config['user'] ?? null;
        $this->pass = $config['pass'] ?? null;
        $this->port = $config['port'] ?? null;
        $this->charset = $config['charset'] ?? null;
        return $this;
    }

    public function adapter()
    {
        return $this->adapter;
    }

    public function host()
    {
        return $this->host;
    }

    public function name()
    {
        return $this->name;
    }

    public function user()
    {
        return $this->user;
    }

    public function pass()
    {
        return $this->pass;
    }

    public function port()
    {
        return $this->port;
    }

    public function charset()
    {
        return $this->charset;
    }
}
