<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapanHdr extends Model
{
    use HasFactory;
    protected $table = "tahapan_hdr";
    protected $primarykey = "id";
    protected $guarded = [];
}
