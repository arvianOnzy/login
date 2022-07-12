<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $table = "lokasi";
    protected $primarykey = "id";
    protected $guarded = [];

    public function dokumen_master()
    {
        return $this->hasMany(Dokumen_Master::class);
    }
}
