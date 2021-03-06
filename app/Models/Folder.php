<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $table = "folder";
    protected $primarykey = "id";
    protected $keyType = 'string';
    protected $guarded = [];
}
