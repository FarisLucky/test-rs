<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @internal
 * @coversNothing
 */
class TipeDiagnosa extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tipe_diagnosa';

    protected $primaryKey = 'id_tipe';

    protected $fillable = [
        'tipe',
    ];

    public function pemeriksaan()
    {
        $this->hasMany(Pemeriksaan::class, 'tipe_pemeriksaan');
    }
}
