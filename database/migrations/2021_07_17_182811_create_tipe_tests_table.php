<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeTestsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tipe_diagnosa', function (Blueprint $table) {
            $table->tinyIncrements('id_tipe');
            $table->string('tipe', 30);
            $table->text('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tipe_test');
    }
}
