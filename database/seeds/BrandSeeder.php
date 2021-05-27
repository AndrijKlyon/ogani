<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            [
                'title' => 'PExpert',
                'alias' => 'pexpert',
                'img' => null,
                'keywords' => 'pexpert',
                'description' => 'pexpert',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'FoodMaster',
                'alias' => 'food-master',
                'img' => null,
                'keywords' => 'foodmaster',
                'description' => 'foodmaster',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Delish',
                'alias' => 'delish',
                'img' => null,
                'keywords' => 'delish',
                'description' => 'delish',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Flavor',
                'alias' => 'flavor',
                'img' => null,
                'keywords' => 'flavor',
                'description' => 'flavor',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Fruit',
                'alias' => 'fruit',
                'img' => null,
                'keywords' => 'fruit',
                'description' => 'fruit',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Vegan',
                'alias' => 'vegan',
                'img' => null,
                'keywords' => 'vegan',
                'description' => 'vegan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Smack',
                'alias' => 'smack',
                'img' => null,
                'keywords' => 'smack',
                'description' => 'smack',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Yummy',
                'alias' => 'yummy',
                'img' => null,
                'keywords' => 'yummy',
                'description' => 'yummy',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

        ]);
    }
}
