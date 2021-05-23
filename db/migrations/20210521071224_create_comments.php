<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateComments extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('comments');
        $table->addTimestamps()
            ->addColumn('author', 'string', ['limit' => 64, 'null' => false])
            ->addColumn('body', 'text', ['null' => false])
            ->addColumn('article_id', 'integer', ['null' => false])
            ->addColumn('thread_id', 'integer', ['null' => false]) //nikdy nemoze byt null,
            ->addColumn('ref_to_comment_id', 'integer', ['null' => true]) //moze byt null lebo comment moze byt prvy v threade
            ->create();
    }
}
