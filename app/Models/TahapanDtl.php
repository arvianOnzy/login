<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahapanDtl extends Model
{
    use HasFactory;
    protected $table = "tahapan_dtl";
    protected $primarykey = "id";
    protected $keyType = 'string';
    protected $guarded = [];
}
