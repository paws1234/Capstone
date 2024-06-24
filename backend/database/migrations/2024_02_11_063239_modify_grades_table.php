<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModifyGradesTable extends Migration
{
    public function up()
    {
        // Disable foreign key checks
        Schema::disableForeignKeyConstraints();

        Schema::table('grades', function (Blueprint $table) {
            $table->unsignedBigInteger('teacher_id')->after('quiz_id');
            // Add a foreign key constraint to the teachers table
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
        });

        // Enable foreign key checks
        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropColumn('teacher_id');
        });
    }
}
