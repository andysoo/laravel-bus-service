<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$dmuvtmtrXAdaf7pOYLJ2s.WnLB99.EjGuV9lV8wWM9i5R8BQpTg1K',
        ]);
    }
}
