<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'registre_id',
        'employe_id',
        'statut',
        'heure_entree',
        'heure_sortie',
    ];

    public function registre()
    {
        return $this->belongsTo(Registre::class);
    }

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
