<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('studymaterials', function (Blueprint $table) {
            $table->string('type')->nullable();  // Add type column
            $table->integer('status')->default(1);  // Add status column with a default value of 0
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('studymaterials', function (Blueprint $table) {
            $table->dropColumn('type');  // Remove type column
            $table->dropColumn('status');  // Remove status column
        });
    }
};
