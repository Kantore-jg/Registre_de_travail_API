<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Presence;
use Illuminate\Http\Request;

class PresenceController extends Controller
{
    public function index(Request $request)
    {
        $query = Presence::with(['employe', 'registre']);

        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('registre_id')) {
            $query->where('registre_id', $request->registre_id);
        }

        if ($request->has('employe_id')) {
            $query->where('employe_id', $request->employe_id);
        }

        if ($request->has('month')) {
            $query->whereMonth('date', $request->month);
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'registre_id' => 'required|exists:registres,id',
            'employe_id' => 'required|exists:employes,id',
            'statut' => 'nullable|in:present,absent,retard',
            'heure_entree' => 'nullable|date_format:H:i',
            'heure_sortie' => 'nullable|date_format:H:i|after:heure_entree',
        ]);

        $presence = Presence::updateOrCreate(
            [
                'date' => $validated['date'],
                'registre_id' => $validated['registre_id'],
                'employe_id' => $validated['employe_id']
            ],
            $validated
        );

        return response()->json($presence, 201);
    }
}
