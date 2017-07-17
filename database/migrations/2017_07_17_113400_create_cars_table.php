<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('color');
            $table->string('model');
            $table->string('registration_number');
            $table->integer('year');
            $table->integer('mileage');
            $table->float('price');
            $table->integer('user_id')->unsigned();
        });

        Schema::table('cars', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign('cars_user_id_foreign');
        });
        Schema::dropIfExists('cars');
    }
}
