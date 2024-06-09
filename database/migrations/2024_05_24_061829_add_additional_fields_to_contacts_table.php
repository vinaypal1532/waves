<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalFieldsToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->string('qualification')->nullable();
            $table->string('c_name')->nullable();
            $table->string('c_location')->nullable();
            $table->integer('y_passing')->nullable();
            $table->boolean('interested')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('qualification');
            $table->dropColumn('c_name');
            $table->dropColumn('c_location');
            $table->dropColumn('y_passing');
            $table->dropColumn('interested');
        });
    }
}
