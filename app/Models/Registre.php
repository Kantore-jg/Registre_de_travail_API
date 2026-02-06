<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registre extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'date_creation',
        'date_fin',
        'status'
    ];

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
}
