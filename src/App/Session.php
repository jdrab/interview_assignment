<?php

declare(strict_types=1);

namespace App;
// najprimitivnejsi sposob aky mi napadol okrem cistych session
class Session
{
    public function __construct(private array $config)
    {
        $this->config = $config;
    }

    public function set(string $key,  $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get(string $key)
    {
        return $_SESSION[$key];
    }


    public function isActive()
    {
        // 0 - PHP_SESSION_DISABLED if sessions are disabled.
        // 1 - PHP_SESSION_NONE if sessions are enabled, but none exists.
        // 2 - PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
        return session_status() === 2;
    }

    public function start()
    {
        session_start($this->config);
    }
    public function destroy()
    {
        session_destroy();
    }

    public function restart()
    {
        session_start();
        session_regenerate_id(true);
    }
    public static function isLoggedIn()
    {
        return !empty($_SESSION['loggedIn']);
    }
}
