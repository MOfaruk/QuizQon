<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('desc');
            $table->integer('nQs');//number of question
            $table->float('negativeMark',8,2)->default(0);
            $table->integer('author_id');
            $table->dateTime('start_on');
            $table->integer('duration');
            $table->string('thumbnail')->nullable();
            $table->integer('nHit')->default(0);
            $table->enum('status',['published','paused','draft'])->default('draft');
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
        Schema::dropIfExists('quizzes');
    }
}
