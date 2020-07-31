<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('occupation')->nullable();
            $table->text('about')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', array('male', 'female', 'other'))->nullable();
            $table->string('alternate_email')->nullable();
            $table->text('address')->nullable();
            $table->string('photo')->nullable();
            $table->text('skillsets')->nullable(); // will be json_encoded
            $table->text('social_links')->nullable(); // will be json_encoded
            $table->string('website')->nullable();
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
        Schema::drop('user_profile');
    }
}
