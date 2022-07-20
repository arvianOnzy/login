<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Role;

class permintaan extends Model
{
    use HasFactory;
    protected $table = "permintaan";
    // protected $primarykey = "id";
    protected $guarded = [];

    public function jenis_dokumen()
    {
        return $this->belongsTo(Jenis_Dokumen::class);
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
