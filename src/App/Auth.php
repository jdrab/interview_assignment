<?php

declare(strict_types=1);

namespace App;
// najprimitivnejsi sposob aky mi napadol okrem cistych session
class Auth
{

    public function __construct(private Db $db)
    {
        $this->db = $db;
    }

    public function login(string $login, string $password): bool
    {
        $q = "SELECT hash from users where login = :login";
        $stmt = $this->db->connect()->prepare($q);
        $stmt->bindParam(':login', $login, \PDO::PARAM_STR);
        $stmt->execute();
        $hash = $stmt->fetch(\PDO::FETCH_ASSOC)['hash'];
        if (is_null($hash)) {
            return false;
        }
        return password_verify($password,  $hash);
    }
}
