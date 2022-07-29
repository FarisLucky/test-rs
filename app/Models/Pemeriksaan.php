<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $table = 'pemeriksaan';

    protected $primaryKey = 'id_pemeriksaan';

    protected $with = ['details'];

    protected $fillable = [
        'no_pa',
        'id_rm',
        'id_pasien',
        'id_dokter_pengirim',
        'id_dokter_perujuk',
        'tgl_terima',
        'tgl_pemeriksaan',
        'tgl_hasil',
        'hasil_patologi',
        'laporan_pemeriksaan',
        'kesimpulan',
    ];

    public function details()
    {
        return $this->hasMany(DetailPemeriksaan::class, 'id_pemeriksaan');
    }

    public function rumahSakit()
    {
        return $this->belongsTo(RumahSakit::class, 'id_rm');
    }

    public function dokterPerujuk()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter_perujuk');
    }

    public function dokterPengirim()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter_pengirim');
    }
    public function tipeDiagnosa()
    {
        return $this->belongsTo(TipeDiagnosa::class, 'id_tipe_diagnosa');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function getFormatTglPemeriksaanAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->tgl_pemeriksaan)->locale('id')->isoFormat('D MMMM Y H:mm');
    }
}
