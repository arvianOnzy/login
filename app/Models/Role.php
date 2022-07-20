<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Permintaan;

class role extends Model
{
    use HasFactory;
    protected $table = "model";
    protected $guarded = [];

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class);
    }
}
