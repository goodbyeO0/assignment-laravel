<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToHallsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->timestamps(); // This will add 'created_at' and 'updated_at' columns
            $table->integer('capacity')->nullable(); // Add capacity column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('halls', function (Blueprint $table) {
            $table->dropTimestamps(); // This will remove 'created_at' and 'updated_at' columns
            $table->dropColumn('capacity'); // This will remove the capacity column
        });
    }
}