<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Theres actually an error here, causing it to fail to migrate:
 * Illuminate\Database\QueryException 
 * SQLSTATE[HY000]: General error: 3780 
 * Referencing column 'subject_id' and 
 * referenced column 'id' in foreign key 
 * constraint 'timetables_subject_id_foreign' 
 * are incompatible. (Connection: mysql, SQL: 
 * alter table `timetables` add constraint 
 * `timetables_subject_id_foreign` 
 * foreign key (`subject_id`) references 
 * `subjects` (`id`))
 * error date: 28 Nov 2024 7.31 PM
 */

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('day_id')->references('id')->on('days');
            $table->foreign('hall_id')->references('id')->on('halls');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timetables', function (Blueprint $table) {
            $table->dropForeign(['subject_id']);
            $table->dropForeign(['day_id']);
            $table->dropForeign(['hall_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['group_id']);
        });
    }
};
