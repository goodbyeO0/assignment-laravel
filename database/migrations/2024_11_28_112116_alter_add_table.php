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
        Schema::table('users', function (Blueprint $table) {
            // Check if the 'age' column does not exist before adding it
            if (!Schema::hasColumn('users', 'age')) {
                $table->string('age')->nullable()->after('name');
            }
        });

        Schema::table('subjects', function (Blueprint $table) {
            // Check if the 'lecturer_name' column does not exist before adding it
            if (!Schema::hasColumn('subjects', 'lecturer_name')) {
                $table->string('lecturer_name')->nullable()->after('subject_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if the 'age' column exists before dropping it
            if (Schema::hasColumn('users', 'age')) {
                $table->dropColumn('age');
            }
        });

        Schema::table('subjects', function (Blueprint $table) {
            // Check if the 'lecturer_name' column exists before dropping it
            if (Schema::hasColumn('subjects', 'lecturer_name')) {
                $table->dropColumn('lecturer_name');
            }
        });
    }
};
