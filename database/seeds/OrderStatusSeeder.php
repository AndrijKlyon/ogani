<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            [
                'title' => 'Новый',
                'alias' => 'new',
                'description' => 'Новый',
                'color' => '#ffe6e6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Обработан',
                'alias' => 'processed',
                'description' => 'Обработан',
                'color' => '#e6f2ff',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Комплектуется',
                'alias' => 'packaging',
                'description' => 'Комплектуется',
                'color' => '#ffffe6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Передан в службу доставки',
                'alias' => 'transferred',
                'description' => 'Передан в службу доставки',
                'color' => '#fff2e6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'В доставке',
                'alias' => 'shipping',
                'description' => 'В доставке',
                'color' => '#fff9e6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Выполнен',
                'alias' => 'completed',
                'description' => 'Выполнен',
                'color' => '#e6ffe6',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Отменен',
                'alias' => 'canceled',
                'description' => 'Отменен',
                'color' => '#ffad99',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Возвращен покупателем',
                'alias' => 'returned',
                'description' => 'Возвращен покупателем',
                'color' => '#ffad99',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            ]);
    }
}
