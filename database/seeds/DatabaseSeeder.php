<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'Admin']
        ]);

        DB::table('users')->insert([
            'id' => (string)Str::uuid(),
            'name' => 'Admin',
            'role_id' => 1,
            'email' => 'admin@app.com',
            'active' => true,
            'first_login' => true,
            'login_attempts' => 0,
            'password' => Hash::make('password'),
        ]);
        DB::table('status')->insert([
            ['name' => 'Em curso'],
            ['name' => 'Em curso pelo supervisor'],
            ['name' => 'Continuo'],
            ['name' => 'Concluido'],
        ]);

    }
}
