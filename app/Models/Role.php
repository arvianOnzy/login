<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Permintaan;
use App\Models\User;

class role extends Model
{
    use HasFactory;
    protected $table = "role";
    protected $guarded = [];

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class);
    }
    public function user()
    {
        return $this->hasMany(User::class);
    }
}
