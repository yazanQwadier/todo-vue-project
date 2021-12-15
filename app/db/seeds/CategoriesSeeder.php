<?php


use Phinx\Seed\AbstractSeed;

class CategoriesSeeder extends AbstractSeed
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
        $data = [
            ['title' => 'المهام اليومية'],
            ['title' => 'المهام الاسبوعية'],
            ['title' => 'المهام الشهرية'],
            ['title' => 'المهام السنوية'],
        ];

        $this->table('categories')->insert($data)->saveData();
    }
}
