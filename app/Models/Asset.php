<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_assets';
    public $incrementing = false;

    protected $fillable = [
        'no_assets',
        'vendor_id',
        'project_id',
        'asset_type_id',
        'pemiliks_id',
        'photo_id',
        'idPart',
        'jumlah'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id', 'id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assetType()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id', 'id');
    }

    public function proses()
    {
        return $this->belongsTo(Proses::class);
    }


    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'pemiliks_id', 'id');
    }

    // Asset.php (Model)
    public function photo()
    {
        return $this->belongsTo(Photo::class, 'photo_id', 'id');
    }

    public function part()
    {
        return $this->belongsTo(Part::class, 'idPart', 'idPart'); // Adjust foreign key and local key if necessary
    }

}