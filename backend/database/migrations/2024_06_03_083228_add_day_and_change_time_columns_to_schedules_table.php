<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDayAndChangeTimeColumnsToSchedulesTable extends Migration
{
    public function up()
    {
        Schema::table('schedules', function (Blueprint $table) {
            $table->string('day')->nullable();
            $table->time('start_time')->change();
            $table->time('end_time')->change();
        });
    }

    public function down()
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Reverse the changes made in the up method
            $table->dropColumn('day');
            $table->dateTime('start_time')->change();
            $table->dateTime('end_time')->change();
        });
    }
}
