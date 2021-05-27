<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelatedProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('related_products')->insert([
            [
                'product_id' => 1,
                'related_id' => 2,
            ],
            [
                'product_id' => 1,
                'related_id' => 3,
            ],
            [
                'product_id' => 1,
                'related_id' => 4,
            ],

            [
                'product_id' => 2,
                'related_id' => 3,
            ],
            [
                'product_id' => 2,
                'related_id' => 4,
            ],
            [
                'product_id' => 2,
                'related_id' => 5,
            ],

            [
                'product_id' => 3,
                'related_id' => 2,
            ],
            [
                'product_id' => 3,
                'related_id' => 4,
            ],
            [
                'product_id' => 3,
                'related_id' => 1,
            ],

            [
                'product_id' => 4,
                'related_id' => 2,
            ],
            [
                'product_id' => 4,
                'related_id' => 3,
            ],
            [
                'product_id' => 4,
                'related_id' => 5,
            ],


            [
                'product_id' => 6,
                'related_id' => 7,
            ],
            [
                'product_id' => 6,
                'related_id' => 8,
            ],
            [
                'product_id' => 6,
                'related_id' => 9,
            ],

            [
                'product_id' => 7,
                'related_id' => 6,
            ],
            [
                'product_id' => 7,
                'related_id' => 8,
            ],
            [
                'product_id' => 7,
                'related_id' => 9,
            ],

            [
                'product_id' => 8,
                'related_id' => 6,
            ],
            [
                'product_id' => 8,
                'related_id' => 7,
            ],
            [
                'product_id' => 8,
                'related_id' => 9,
            ],

            [
                'product_id' => 9,
                'related_id' => 10,
            ],
            [
                'product_id' => 9,
                'related_id' => 11,
            ],
            [
                'product_id' => 9,
                'related_id' => 12,
            ],

            [
                'product_id' => 10,
                'related_id' => 11,
            ],
            [
                'product_id' => 10,
                'related_id' => 12,
            ],
            [
                'product_id' => 10,
                'related_id' => 13,
            ],

            [
                'product_id' => 11,
                'related_id' => 12,
            ],
            [
                'product_id' => 11,
                'related_id' => 13,
            ],
            [
                'product_id' => 11,
                'related_id' => 14,
            ],

            [
                'product_id' => 12,
                'related_id' => 13,
            ],
            [
                'product_id' => 12,
                'related_id' => 11,
            ],
            [
                'product_id' => 12,
                'related_id' => 14,
            ],

            [
                'product_id' => 13,
                'related_id' => 14,
            ],
            [
                'product_id' => 13,
                'related_id' => 15,
            ],
            [
                'product_id' => 13,
                'related_id' => 12,
            ],

            [
                'product_id' => 14,
                'related_id' => 12,
            ],
            [
                'product_id' => 14,
                'related_id' => 13,
            ],
            [
                'product_id' => 14,
                'related_id' => 15,
            ],

            [
                'product_id' => 15,
                'related_id' => 13,
            ],
            [
                'product_id' => 15,
                'related_id' => 14,
            ],
            [
                'product_id' => 15,
                'related_id' => 16,
            ],

            [
                'product_id' => 16,
                'related_id' => 15,
            ],
            [
                'product_id' => 16,
                'related_id' => 14,
            ],
            [
                'product_id' => 16,
                'related_id' => 17,
            ],

            [
                'product_id' => 17,
                'related_id' => 18,
            ],
            [
                'product_id' => 17,
                'related_id' => 16,
            ],
            [
                'product_id' => 17,
                'related_id' => 19,
            ],

            [
                'product_id' => 18,
                'related_id' => 19,
            ],
            [
                'product_id' => 18,
                'related_id' => 20,
            ],
            [
                'product_id' => 18,
                'related_id' => 17,
            ],

            [
                'product_id' => 19,
                'related_id' => 20,
            ],
            [
                'product_id' => 19,
                'related_id' => 21,
            ],
            [
                'product_id' => 19,
                'related_id' => 17,
            ],

            [
                'product_id' => 20,
                'related_id' => 21,
            ],
            [
                'product_id' => 20,
                'related_id' => 22,
            ],
            [
                'product_id' => 20,
                'related_id' => 23,
            ],

            [
                'product_id' => 21,
                'related_id' => 22,
            ],
            [
                'product_id' => 21,
                'related_id' => 23,
            ],
            [
                'product_id' => 21,
                'related_id' => 24,
            ],

            [
                'product_id' => 22,
                'related_id' => 20,
            ],
            [
                'product_id' => 22,
                'related_id' => 21,
            ],
            [
                'product_id' => 22,
                'related_id' => 23,
            ],

            [
                'product_id' => 23,
                'related_id' => 22,
            ],
            [
                'product_id' => 23,
                'related_id' => 21,
            ],
            [
                'product_id' => 23,
                'related_id' => 24,
            ],

            [
                'product_id' => 24,
                'related_id' => 20,
            ],
            [
                'product_id' => 24,
                'related_id' => 22,
            ],
            [
                'product_id' => 24,
                'related_id' => 23,
            ],

            [
                'product_id' => 25,
                'related_id' => 22,
            ],
            [
                'product_id' => 26,
                'related_id' => 27,
            ],
            [
                'product_id' => 27,
                'related_id' => 28,
            ],
            [
                'product_id' => 28,
                'related_id' => 27,
            ],
            [
                'product_id' => 29,
                'related_id' => 28,
            ],
            [
                'product_id' => 30,
                'related_id' => 29,
            ],
            [
                'product_id' => 30,
                'related_id' => 28,
            ],

        ]);
    }
}
