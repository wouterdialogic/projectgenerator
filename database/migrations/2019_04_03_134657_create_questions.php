<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name')->unique();
            $table->string('question');
            $table->text('question_detailed');
            $table->text('answer')->nullable();
            $table->integer('rating')->nullable();
            // $table->integer('user_id')->unsigned();
            $table->string('modified_by')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->nullable();

            $table->timestamps();
        });

        Schema::create('questions_log', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();
            $table->string('question');
            $table->text('question_detailed');
            $table->text('answer')->nullable();
            $table->integer('rating')->nullable();
            // $table->integer('user_id')->unsigned();
            $table->integer('question_id')->unsigned();
            $table->string('modified_by')->nullable();
            $table->foreign('question_id')->references('id')->on('questions');

            $table->timestamps();
        });

        Schema::create('tags', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('tag');
        });

        Schema::create('question_tag', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('question_id');
            $table->integer('tag_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
        Schema::dropIfExists('questions_log');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('question_tag');
    }
}
