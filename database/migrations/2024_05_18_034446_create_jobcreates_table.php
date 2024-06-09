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
        Schema::create('jobcreates', function (Blueprint $table) {
            $table->id();
            $table->string('domain');
            $table->string('title');
            $table->string('c_name'); // assuming this is the company name
            $table->integer('exp'); 
            $table->string('mobile_no');
            $table->string('contact_person');
            $table->string('email');
            $table->text('details');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobcreates');
    }
};
