<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerahTerima extends Model
{
    use HasFactory;
    protected $fillable = [
        'dkasset',
        'nama_penerima',
        'divisi_penerima',
        'jabatan_penerima',
        'ttd_penerima',
        'nama_penyerah',
        'divisi_penyerah',
        'jabatan_penyerah',
        'ttd_penyerah',
        'kondisi',
        'foto',
        'tempat',
        'deskripsi',
        'bukti',
        'waktu',
    ];
    public function barang()
    {
        return $this->morphTo();
    }
}
