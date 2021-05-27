<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_tags')->insert([
            [
                'title' => 'мясо',
                'alias' => 'meat',
                'keywords' => 'мясо',
                'description' => 'мясо',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'рыба',
                'alias' => 'fish',
                'keywords' => 'рыба',
                'description' => 'рыба',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'молоко',
                'alias' => 'milk',
                'keywords' => 'молоко',
                'description' => 'молоко',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'колбасы',
                'alias' => 'sausages',
                'keywords' => 'колбасы',
                'description' => 'колбасы',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'крупы',
                'alias' => 'cereals',
                'keywords' => 'крупы',
                'description' => 'крупы',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'сыры',
                'alias' => 'cheeses',
                'keywords' => 'сыры',
                'description' => 'сыры',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'напитки',
                'alias' => 'drinks',
                'keywords' => 'напитки',
                'description' => 'напитки',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'сладости',
                'alias' => 'sweets',
                'keywords' => 'сладости',
                'description' => 'сладости',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

        ]);
    }
}
