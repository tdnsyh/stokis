<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stokis extends Model
{
    use HasFactory;
    protected $table = 'stokis';

    protected $fillable = [
        'kokab_id',
        'kecamatan_id',
        'nama_stokis',
        'no_hp',
        'member',
        'nama_member'
    ];

    public function kokab()
    {
        return $this->belongsTo(Kokab::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
