<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';

    protected $fillable = ['kokab_id', 'nama_kecamatan'];

    public function kokab()
    {
        return $this->belongsTo(Kokab::class);
    }

    public function stokis()
    {
        return $this->hasMany(Stokis::class);
    }
}
