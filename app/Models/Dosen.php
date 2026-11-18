<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen_bimbingan';
    protected $primaryKey = 'nidn';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'nidn',
        'nama',
        'foto',
        'jabatan',
        'kepakaran',
        'email',
        'pendidikan',
        'deskripsi',
    ];
}
