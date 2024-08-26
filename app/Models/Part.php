<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_number';

    protected $fillable = [
        'idPart',
        'part_name',
        'spek_material',

        'spek_mesin'
    ];

    
}