<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function games()
    {
        return $this->belongsTo(Game::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}

