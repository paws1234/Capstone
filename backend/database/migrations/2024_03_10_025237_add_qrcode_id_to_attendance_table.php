<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQrcodeIdToAttendanceTable extends Migration
{
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('qrcode_id')->nullable();
            $table->foreign('qrcode_id')->references('id')->on('qr_code_data');
        });
    }

    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['qrcode_id']);
            $table->dropColumn('qrcode_id');
        });
    }
}
