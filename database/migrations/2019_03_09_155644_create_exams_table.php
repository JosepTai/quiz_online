<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('class_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('test_id')->references('id')->on('tests');
            $table->integer('duration');
            $table->text('ststus');
            $table->DateTime('endtime');
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
        Schema::dropIfExists('exams');
    }
}
