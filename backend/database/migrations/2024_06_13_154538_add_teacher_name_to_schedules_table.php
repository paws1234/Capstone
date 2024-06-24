<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeacherNameToSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('teacher_name')->nullable();

             $table->unique('teacher_name');

            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->foreign('teacher_id')
                  ->references('id')->on('teachers')
                  ->onDelete('set null');

            $table->index(['teacher_name', 'teacher_id']);
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['teacher_id']);

            // Drop columns
            $table->dropColumn(['teacher_name', 'teacher_id']);
        });
    }
}
