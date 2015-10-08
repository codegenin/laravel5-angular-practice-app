<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dates', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->timestamp('time');
            $table->string('place');
            $table->string('location_name');
            $table->integer('location_lat');
            $table->integer('location_long');
            $table->enum('state', ['active', 'pending', 'completed']);
            $table->integer('owner_id')->unsigned()->lenght(10);
            $table->foreign('owner_id')->references('id')->on('users');
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
        Schema::drop('dates');
    }
}
