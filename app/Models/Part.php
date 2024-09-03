<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $primaryKey = 'idPart';
    public $incrementing = false;

    protected $fillable = [
        'idPart',
        'part_name',
        'spek_material',

    ];


}