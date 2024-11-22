<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'id_pengaduan',
        'tanggal_pengaduan',
        'nik',
        'isi_laporan',
        'foto',
        'status',
    ];

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }
}
