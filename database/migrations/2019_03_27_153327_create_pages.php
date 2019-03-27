<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('name')->unique();
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            // $table->integer('project_id')->nullable();
            // $table->foreign('project_id')->references('id')->on('projects');
            $table->string('owner')->nullable();
            $table->text('description')->nullable();
            $table->integer('order')->nullable();

            $table->timestamps();
        });
        // Schema::create('pages', function (Blueprint $table) {
        //     $table->foreign('project_id')->references('id')->on('projects');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
