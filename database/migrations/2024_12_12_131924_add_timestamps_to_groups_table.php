<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToGroupsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->timestamps(); // This will add 'created_at' and 'updated_at' columns
            $table->integer('capacity')->nullable(); // Add capacity column
            $table->string('department')->nullable(); // Add department column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropTimestamps(); // This will remove 'created_at' and 'updated_at' columns
            $table->dropColumn('capacity'); // Remove capacity column
            $table->dropColumn('department'); // Remove department column
        });
    }
}