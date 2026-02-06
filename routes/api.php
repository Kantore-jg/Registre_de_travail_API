<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\EmployeController;
use App\Http\Controllers\Api\PresenceController;
use App\Http\Controllers\Api\RegistreController;

Route::group([], function () {
    // --- Gestion des Employés ---
    // GET /employes, POST /employes, GET /employes/{id}, PUT /employes/{id}, DELETE /employes/{id}
    Route::apiResource('employes', EmployeController::class);
    // --- Gestion des Registres ---
    // GET /registres, POST /registres, GET /registres/{id}, DELETE /registres/{id}
    Route::apiResource('registres', RegistreController::class);

    // Route spécifique pour changer le statut (ex: passer à 'expiré')
    Route::patch('registres/{registre}/status', [RegistreController::class, 'updateStatus']);
    // --- Gestion des Présences ---
    // Consultations avec filtres (date, mois, employe_id, registre_id)
    Route::get('presences', [PresenceController::class, 'index']);

    // Enregistrer ou mettre à jour une présence (pour une date et un employé précis)
    Route::post('presences', [PresenceController::class, 'store']);
});
