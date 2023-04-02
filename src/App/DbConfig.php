<?php

declare(strict_types=1);

namespace App;

use Interface\DbConfigInterface;

class DbConfig implements DbConfigInterface
{
    private ?string $adapter;
    private ?string $host;
    private ?string $name;
    private ?string $user;
    private ?string $pass;
    private ?int $port;
    private ?string $charset;

    public function __construct(array $config)
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
