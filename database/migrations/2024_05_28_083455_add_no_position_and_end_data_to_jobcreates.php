<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoPositionAndEndDataToJobcreates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jobcreates', function (Blueprint $table) {
            $table->integer('no_position')->nullable(); // Add no_position column
            $table->date('end_data')->nullable();       // Add end_data column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jobcreates', function (Blueprint $table) {
            $table->dropColumn('no_position'); // Drop no_position column
            $table->dropColumn('end_data');    // Drop end_data column
        });
    }
}
