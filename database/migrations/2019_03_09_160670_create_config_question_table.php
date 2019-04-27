<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('config_question', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('config_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('config_id')->references('id')->on('configs');
            $table->foreign('question_id')->references('id')->on('questions');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('user_selected');
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
        //
        Schema::dropIfExists('question_test');
    }
}
