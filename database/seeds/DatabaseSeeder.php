<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AboutrecordSeeder::class,
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            OptionSeeder::class,
            OrderStatusSeeder::class,
            PayMethodSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            PostTagSeeder::class,
            Post_TagSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            RelatedProductSeeder::class,
            ShippingMethodSeeder::class,
            SpecificationSeeder::class,
            ModificationSeeder::class,
            WeekDealSeeder::class,
            ShopinfoSeeder::class,
            BannerSeeder::class,
    	]);
    }
}
