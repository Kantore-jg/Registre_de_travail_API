<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    public function index()
    {
        return response()->json(Employe::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:employes,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'matricule' => 'required|string|unique:employes,matricule',
            'poste' => 'nullable|string|max:255',
        ]);

        $employe = Employe::create($validated);

        return response()->json($employe, 201);
    }

    public function show(Employe $employe)
    {
        return response()->json($employe);
    }

    public function update(Request $request, Employe $employe)
    {
        $validated = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:employes,email,'.$employe->id,
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'matricule' => 'sometimes|required|string|unique:employes,matricule,'.$employe->id,
            'poste' => 'nullable|string|max:255',
        ]);

        $employe->update($validated);

        return response()->json($employe);
    }

    public function destroy(Employe $employe)
    {
        $employe->delete();

        return response()->json(null, 204);
    }
}
