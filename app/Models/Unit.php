<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Unit extends Model
{
    use HasFactory;
    protected $table = "unit";
    protected $primarykey = "id";
    protected $guarded = [];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
