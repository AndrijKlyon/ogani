<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\EModels\Modification;

class ModificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 30; $i++) {
            if($i%2 == 0) {
                for($j = 1; $j <= 4; $j++) {
                    $option_id = rand(1, 8);
                    $modification = Modification::where(['product_id' => $i,'option_id'=> $option_id])->get();
                    if($modification->isEmpty()) {
                        DB::table('modifications')->insert([
                            [
                                'product_id' => $i,
                                'option_id' => $option_id,
                            ],
                        ]);
                    }
                }
            }
        }
    }

}
