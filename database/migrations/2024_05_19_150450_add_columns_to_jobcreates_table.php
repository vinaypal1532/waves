<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('jobcreates', function (Blueprint $table) {
            $table->string('location')->nullable();
            $table->boolean('is_c_name')->default(false);
            $table->boolean('is_email')->default(false);
            $table->boolean('is_mobile')->default(false);
            $table->boolean('is_contact_person')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('jobcreates', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('is_c_name');
            $table->dropColumn('is_email');
            $table->dropColumn('is_mobile');
            $table->dropColumn('is_contact_person');
        });
    }
};
