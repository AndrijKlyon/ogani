<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post_categories')->insert([
            [
                'title' => 'Мясо и колбасы',
                'alias' => 'meat-sausages',
                'keywords' => 'мясо, колбасы',
                'description' => 'мясо и колбасы',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Рыба и морепродукты',
                'alias' => 'fish-seafood',
                'keywords' => 'рыба, морепродукты',
                'description' => 'рыба и морепродукты',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Молоко и молочные продукты',
                'alias' => 'milk-products',
                'keywords' => 'молоко, молочные продукты',
                'description' => 'молоко и молочные продукты',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Крупы и каши',
                'alias' => 'cereals-kashas',
                'keywords' => 'крупы, каши',
                'description' => 'крупы и каши',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Чай, кофе и напитки',
                'alias' => 'tea-coffee-drinks',
                'keywords' => 'чай, кофе, напитки',
                'description' => 'чай, кофе и напитки',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
