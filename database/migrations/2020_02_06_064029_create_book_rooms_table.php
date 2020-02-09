<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('from');
            $table->dateTime('to');
            $table->string('email');
            $table->string('number');
            $table->string('name');
            $table->string('address');
            $table->integer('room_id')->unsigned();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('book_rooms');
    }
}
