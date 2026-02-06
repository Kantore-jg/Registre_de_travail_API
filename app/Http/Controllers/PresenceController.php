<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class PresenceController extends Controller
{
    Schema::create('presences', function (Blueprint $table) {
    $table->id();
    $table->date('date');
    $table->foreignId('registre_id')->constrained();
    $table->foreignId('employe_id')->constrained();
    $table->enum('statut', ['present', 'absent', 'retard'])->nullable();
    $table->time('heure_entree')->nullable();
    $table->time('heure_sortie')->nullable();
    $table->timestamps();
    
    // Empêche d'avoir deux lignes pour le même employé le même jour dans le même registre
    $table->unique(['date', 'registre_id', 'employe_id']);
});

}
