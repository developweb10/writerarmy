<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('package_id');
            $table->integer('total_words')->nullable();
            $table->integer('quantity');
            $table->string('topic')->nullable();
            $table->string('type_of_press_release')->nullable();
            $table->string('type_style')->nullable();
            $table->string('reference_url')->nullable();
            $table->string('quotes')->nullable();
            $table->string('types_of_posts')->nullable();
            $table->string('target_audience')->nullable();
            $table->boolean('direct_posting')->default(0)->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('order_details');
            $table->double('price');
            $table->string('attachment')->nullable();
            $table->integer('order_placed_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
