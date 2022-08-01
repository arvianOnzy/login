<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class TahapanHdr extends Model
{
    use HasFactory;
    protected $table = "tahapan_hdr";
    protected $primarykey = "id";
    protected $guarded = [];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
