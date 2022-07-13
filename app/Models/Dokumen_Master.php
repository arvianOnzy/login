<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen_Master extends Model
{
    use HasFactory;
    protected $table = "dokumen_master";
    // protected $primarykey = "id";
    protected $guarded = [];
    // protected $fillable = ['id', 'nama_dok', 'lokasi', 'lokasi_id', 'no_dok', 'jenisdok_id'];


    public function jenis_dokumen()
    {
        return $this->belongsTo(Jenis_Dokumen::class);
    }
    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
    // public function jenises()
    // {
    //     return Jenis_Dokumen::where('dokumen_id', '=', $this->id)->get();
    // }

    public function scopeSearch($query, $name)
    {
        return $query->where('name', 'LIKE', "%{$name}%");
    }
}
