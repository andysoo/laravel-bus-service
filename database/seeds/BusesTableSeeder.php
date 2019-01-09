<?php

use Illuminate\Database\Seeder;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buses')->insert([
            ['plate-number' => 17937, 'line' => '上海'],
            ['plate-number' => 17933, 'line' => '上海'],
            ['plate-number' => 17007, 'line' => '上海'],
            ['plate-number' => 15330, 'line' => '宣城'],
            ['plate-number' => 15332, 'line' => '宣城'],
            ['plate-number' => 15333, 'line' => '宣城'],
            ['plate-number' => 15372, 'line' => '宣城'],
            ['plate-number' => 15375, 'line' => '宣城'],
            ['plate-number' => 16552, 'line' => '南京'],
            ['plate-number' => 16555, 'line' => '南京'],
            ['plate-number' => 16556, 'line' => '南京'],
            ['plate-number' => 16567, 'line' => '南京'],
            ['plate-number' => 16559, 'line' => '南京'],
            ['plate-number' => 16136, 'line' => '南京'],
            ['plate-number' => 16572, 'line' => '溧阳'],
            ['plate-number' => 16565, 'line' => '溧阳'],
            ['plate-number' => 16575, 'line' => '溧阳'],
            ['plate-number' => 16585, 'line' => '杭州'],
            ['plate-number' => 16385, 'line' => '合肥'],
            ['plate-number' => 16596, 'line' => '合肥'],
            ['plate-number' => 16361, 'line' => '合肥'],
            ['plate-number' => 15992, 'line' => '普客'],
            ['plate-number' => 16366, 'line' => '普客'],
            ['plate-number' => 16379, 'line' => '普客'],
            ['plate-number' => 14990, 'line' => '旅游'],
            ['plate-number' => 14979, 'line' => '旅游'],
            ['plate-number' => 12811, 'line' => '旅游'],
            ['plate-number' => 16592, 'line' => '旅游'],
            ['plate-number' => 16367, 'line' => '旅游'],
            ['plate-number' => 14479, 'line' => '旅游'],
        ]);
    }
}
