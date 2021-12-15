<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Users extends AbstractMigration
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
        if( !$this->hasTable('users') ){
            $this->table('users')
                ->addColumn('username', 'text')
                ->addColumn('email', 'text')
                ->addColumn('password', 'text')
                ->addTimestamps(null, null)
                ->create();
        }
    }
}
