<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatKuliner extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar',
        'nama_tempat',
        'alamat',
        'jenis_makanan',
        'jam_operasional',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
