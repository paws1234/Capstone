<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrCodeDataTable extends Migration
{
    public function up()
    {
        Schema::create('qr_code_data', function (Blueprint $table) {
            $table->id();
            $table->string('qr_code');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('qr_code_data');
    }
}
