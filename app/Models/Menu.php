<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempat_kuliner_id',
        'nama_menu',
        'harga',
        'deskripsi',
        'gambar',
    ];

    public function tempatKuliner()
    {
        return $this->belongsTo(TempatKuliner::class);
    }
}
