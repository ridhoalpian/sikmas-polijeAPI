<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendanaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'idpendanaan';

    protected $table = 'pendanaan';

    protected $guarded = [
        'idpendanaan',
        'user_id',
        'kegiatan_id',
        'anggaran_tersedia',
        'periode',
        'status_anggaran'
    ];
}
