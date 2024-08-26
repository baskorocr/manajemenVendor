<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilik extends Model
{
    use HasFactory;

    protected $fillable = ['name_pemilik'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'pemiliks_id', 'id');
    }
}