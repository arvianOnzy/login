<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis_Dokumen extends Model
{
    use HasFactory;
    protected $table = "jenis_dokumen";
    protected $primarykey = "id";
    protected $guarded = [];
    // protected $fillable = ['id', 'jenis'];

    public function dokumen_master()
    {
        return $this->hasMany(Dokumen_Master::class);
    }
}
