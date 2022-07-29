<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RumahSakit extends Model
{
    use HasFactory;

    protected $table = 'rumah_sakit';

    protected $primaryKey = 'id_rm';

    protected $fillable = ['nama_rm'];
}
