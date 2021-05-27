<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 30; $i++) {
            for($j = 1; $j <= 3; $j++) {

                if($j == 1) {
                    DB::table('specifications')->insert([
                        'product_id' => $i,
                        'feature' => 'Вес',
                        'value' => Arr::random([
                            '500 г',
                            '1 кг',
                            '900 г'
                        ]),
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                }
                if($j == 2) {
                    DB::table('specifications')->insert([
                        'product_id' => $i,
                        'feature' => 'Упаковка',
                        'value' => Arr::random([
                            'банка',
                            'тетра-пак',
                            'пакет'
                        ]),
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}
