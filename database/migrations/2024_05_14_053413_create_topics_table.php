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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Add 'name' column
            $table->enum('status', [1, 0])->default(1); // Add 'status' column
            $table->string('image')->nullable(); // Add 'image' column
            $table->unsignedBigInteger('domain_id'); // Add 'domain_id' column
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade'); // Add foreign key constraint
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};
