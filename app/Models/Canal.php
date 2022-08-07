<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canal extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function juegos()
    {
        return $this->belongsTo(Juego::class);
    }
    public function mensaje()
    {
        return $this->hasMany(Mensaje::class);
    }
}

