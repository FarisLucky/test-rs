<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Poli;
use App\Models\RumahSakit;
use App\Models\TipeDiagnosa;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            // PemeriksaanSeeder::class,
        ]);
        Dokter::create([
            'nama_dokter' => 'DR Trisno F, Sp U'
        ]);
        Pasien::factory()->count(5)->create();
        Penyakit::create([
            'nama' => 'Makroskopis',
            'keterangan' => 'lorem ipsum',
        ]);
        Poli::create([
            'nama_poli' => 'ruangan 1'
        ]);
        RumahSakit::create([
            'no_rm' => '098556',
            'nama_rm' => 'GRAHA SEHAT',
        ]);
        TipeDiagnosa::create([
            'tipe' => 'BPH BETENSIO',
            'keterangan' => 'keterangan diagnosa'
        ]);
    }
}
