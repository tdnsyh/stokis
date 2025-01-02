<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kokab extends Model
{
    use HasFactory;
    protected $table = 'kokab';

    protected $fillable = ['nama_kokab'];

    public function kecamatan()
    {
        return $this->hasMany(Kecamatan::class);
    }
}
