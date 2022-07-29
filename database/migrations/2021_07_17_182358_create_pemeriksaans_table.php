<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaansTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->tinyIncrements('id_dokter');
            $table->string('nama_dokter', 50);
        });

        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->increments('id_pemeriksaan');
            $table->string('no_pa', 50);
            $table->unsignedInteger('id_rm');
            $table->unsignedInteger('id_pasien');
            $table->unsignedTinyInteger('id_dokter_pengirim');
            $table->unsignedTinyInteger('id_dokter_perujuk');
            $table->unsignedTinyInteger('id_tipe_diagnosa');
            $table->dateTime('tgl_terima')->nullable();
            $table->dateTime('tgl_pemeriksaan')->nullable();
            $table->dateTime('tgl_hasil')->nullable();
            $table->string('hasil_patologi')->nullable();
            $table->string('laporan_pemeriksaan')->nullable();
            $table->text('kesimpulan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dokter');
        Schema::dropIfExists('pemeriksaan');
    }
}
