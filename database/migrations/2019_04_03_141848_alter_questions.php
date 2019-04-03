<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class AlterQuestions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // DB::table('questions')
        //     ->select(DB::raw('ALTER TABLE questions DROP FOREIGN KEY user_id'));
        // DB::table('questions_log')
        //     ->select(DB::raw('ALTER TABLE questions_log DROP FOREIGN KEY user_id'));ALTER TABLE questions DROP FOREIGN KEY questions_user_id_foreign
        
        //ALTER TABLE questions DROP FOREIGN KEY questions_user_id_foreign

        Schema::table('questions', function (Blueprint $table) {
            // $table->dropColumn('user_id');
            $table->string('owner_name')->nullable();
        });
        
        Schema::table('questions_log', function (Blueprint $table) {
            // $table->dropColumn('user_id');
            $table->string('owner_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('owner_name');
        });
        
        Schema::table('questions_log', function (Blueprint $table) {
            $table->dropColumn('owner_name');
        });
    }
}
