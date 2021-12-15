<?php


use Phinx\Seed\AbstractSeed;

class PrioritiesSeeder extends AbstractSeed
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
            ['name' => 'مرتفعة', 'priority' => 1, 'color' => '#fbff00'],
            ['name' => 'متوسطة', 'priority' => 2, 'color' => '#c3b8ff'],
            ['name' => 'منخفضة', 'priority' => 3, 'color' => '#f5f5f5e8'],
        ];

        $this->table('priorities')->insert($data)->saveData();
    }
}
