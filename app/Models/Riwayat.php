<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    use HasFactory;
    protected $fillable = ['no_assets', 'idUser', 'StatusAwal', 'StatusAkhir', 'bukti', 'TanggalPemindahan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}