<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lpj extends Model
{
    use HasFactory;
    protected $primaryKey = 'idlpj';

    protected $table = 'lpj';

    protected $guarded = ['idlpj'];
    protected $fillable = [
        'user_id',
        'proker_id',
        'file_lpj',
        'status_lpj'
    ];
}
