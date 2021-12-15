<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Tasks extends AbstractMigration
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
        if( !$this->hasTable('tasks') ){
            $this->table('tasks')
                ->addColumn('user_id', 'integer')
                ->addForeignKey('user_id', 'users', 'id')
                ->addColumn('category_id', 'integer')
                ->addForeignKey('category_id', 'categories', 'id')
                ->addColumn('priority_id', 'integer')
                ->addForeignKey('priority_id', 'priorities', 'id')
                ->addColumn('content', 'text')
                ->addColumn('has_done', 'smallinteger', ['default' => 0])
                ->addTimestamps(null, null)
                ->create();
        }
    }
}
