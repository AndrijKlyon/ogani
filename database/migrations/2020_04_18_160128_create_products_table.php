<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('brand_id')->unsigned();
            $table->string('title', 255);
            $table->string('alias', 255)->unique();
            $table->text('content')->nullable();
            $table->float('price', 9, 2)->default(0);
            $table->float('special_price', 9, 2)->nullable();
            $table->enum('status', [0, 1])->default(1);
            $table->string('keywords', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->enum('hit', [0, 1])->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
