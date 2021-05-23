<?php

use Phinx\Seed\AbstractSeed;

class CreateAdminUser extends AbstractSeed
{

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run()
    {
        $session = require __DIR__ . '/../../config/session.php';

        $hash = password_hash(
            $session['default_password'],
            $session['algo'],
            $session['argon2_options']
        );

        $this->table('users')->insert([
            'login' => $session['default_login'],
            'hash' => $hash
        ])->save();
    }
}
