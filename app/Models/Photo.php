<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = ['path', 'name'];

   
    // Photo.php (Model)
    public function assets()
    {
        return $this->hasMany(Asset::class, 'photo_id', 'id');
    }


}