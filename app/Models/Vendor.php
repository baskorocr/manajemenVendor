<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = ['name_vendor'];

    public function assets()
    {
        return $this->hasMany(Asset::class, 'vendor_id', 'id');
    }
}