<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    use HasFactory;
    protected $fillable = ['proses_name'];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}