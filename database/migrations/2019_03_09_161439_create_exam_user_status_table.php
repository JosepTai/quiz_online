<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamUserStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_user_status', function (Blueprint $table) {
            $table->integer('status_id')->unsigned();
            $table->integer('exam_user_id')->unsigned();
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('exam_user_id')->references('id')->on('exam_user');
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
        Schema::dropIfExists('exam_user_status');
    }
}
