<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Registre;
use Illuminate\Http\Request;

class RegistreController extends Controller
{
    public function index()
    {
        return response()->json(Registre::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'date_creation' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_creation',
            'status' => 'nullable|in:actif,expiré',
        ]);

        $registre = Registre::create($validated);

        return response()->json($registre, 201);
    }

    public function show(Registre $registre)
    {
        return response()->json($registre);
    }

    public function update(Request $request, Registre $registre)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'date_creation' => 'sometimes|required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_creation',
            'status' => 'sometimes|required|in:actif,expiré',
        ]);

        $registre->update($validated);

        return response()->json($registre);
    }

    public function updateStatus(Request $request, Registre $registre)
    {
        $validated = $request->validate([
            'status' => 'required|in:actif,expiré',
        ]);

        $registre->update(['status' => $validated['status']]);

        return response()->json($registre);
    }

    public function destroy(Registre $registre)
    {
        $registre->delete();

        return response()->json(null, 204);
    }
}
