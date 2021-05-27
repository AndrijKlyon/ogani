<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_methods')->insert([
            [
                'title' => 'Новая почта (самовывоз)',
                'price' => 50,
                'alias' => 'new-post-self',
                'description' => 'Новая почта (самовывоз)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Новая почта (курьер)',
                'price' => 75,
                'alias' => 'new-post-courier',
                'description' => 'Новая почта (курьер)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Укрпочта (самовывоз)',
                'price' => 30,
                'alias' => 'ukr-post-self',
                'description' => 'Укрпочта (самовывоз)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Укрпочта (курьер)',
                'price' => 50,
                'alias' => 'ukr-post-courier',
                'description' => 'Укрпочта (курьер)',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

        ]);
    }
}
