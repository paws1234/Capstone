<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveQrcodeFromAttendanceTable extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('qr_code');
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->string('qr_code');
        });
    }
}
