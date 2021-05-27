<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShopinfoSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('shopinfos')->insert([
            [
                'title' => 'ЧаВо',
                'user_id' => 1,
                'alias' => 'faq',
                'img' => 'faq.jpg',
                'description' => 'Ответы на часто задаваемые вопросы',
                'text' => '<div class="quote-wrapper">
                            <div class="quotes">
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money.
                            </div>
                            </div>
                            <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower to actually sit through a
                            self-imposed MCSE training. who has the willpower to actually
                            </p>

                            <div class="quote-wrapper">
                            <div class="quotes">
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money.
                            </div>
                            </div>
                            <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower to actually sit through a
                            self-imposed MCSE training. who has the willpower to actually
                            </p>

                            <div class="quote-wrapper">
                            <div class="quotes">
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money.
                            </div>
                            </div>
                            <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower to actually sit through a
                            self-imposed MCSE training. who has the willpower to actually
                            </p>

                            <div class="quote-wrapper">
                            <div class="quotes">
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money.
                            </div>
                            </div>
                            <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower to actually sit through a
                            self-imposed MCSE training. who has the willpower to actually
                            </p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Условия предоставления услуг',
                'user_id' => 1,
                'alias' => 'terms',
                'img' => 'terms.jpg',
                'description' => 'Условия и правила предоставления услуг',
                'text' => '<p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower
                            </p>
                            <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower to actually sit through a
                            self-imposed MCSE training. who has the willpower to actually
                        </p>
                        <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower
                            </p>
                            <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower to actually sit through a
                            self-imposed MCSE training. who has the willpower to actually
                        </p>
                        <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower
                            </p>
                            <p>
                            MCSE boot camps have its supporters and its detractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get the MCSE study materials yourself at a
                            fraction of the camp price. However, who has the willpower to actually sit through a
                            self-imposed MCSE training. who has the willpower to actually
                        </p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
