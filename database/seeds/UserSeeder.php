<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'role' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('12345678'),
                'description' => 'главный редактор',
                'firstname' => 'Павел',
                'lastname' => 'Иванов',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'user',
                'role' => 'user',
                'email' => 'user@mail.com',
                'description' => '',
                'firstname' => '',
                'lastname' => '',
                'password' => bcrypt('12345678'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
