<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama",
        "deskripsi",
    ];
    public function barang() {
        return $this->hasMany(Barang::class, 'jabatanId');
    }
}
