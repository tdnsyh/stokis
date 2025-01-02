<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $fillable = [
        'stokis_id',
        'tahun',
        'jan',
        'feb',
        'mar',
        'apr',
        'mei',
        'jun',
        'jul',
        'agt',
        'sep',
        'okt',
        'nov',
        'des',
        'total'
    ];

    public function stokis()
    {
        return $this->belongsTo(Stokis::class);
    }
}
