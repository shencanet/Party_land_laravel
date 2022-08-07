<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function canal()
    {
        return $this->belongsTo(Canal::class);
    }
}