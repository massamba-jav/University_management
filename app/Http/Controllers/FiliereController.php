<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Departement;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filieres = Filiere::withCount('etudiants')->with('departement')->orderBy('created_at', 'desc')->paginate(10);

        return view('filieres.index', ['filieres' => $filieres]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departements = Departement::all();
        return view('filieres.form', ['departements' => $departements]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'droit_inscription' => 'required|numeric|min:0',
            'mensualite' => 'required|numeric|min:0',
            'departement_id' => 'required|exists:departements,id',
        ]);

        Filiere::create($validated);

        return redirect()->route('filieres.index')->with('success', 'Filière créée !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filiere $filiere)
    {
        $filiere->load(['departement']);
        return view('filieres.show', ['filiere' => $filiere]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filiere $filiere)
    {
        $departements = Departement::all();
        return view('filieres.form', ['filiere' => $filiere, 'departements' => $departements]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filiere $filiere)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'droit_inscription' => 'required|numeric|min:0',
            'mensualite' => 'required|numeric|min:0',
            'departement_id' => 'required|exists:departements,id',
        ]);

        $filiere->update($validated);

        return redirect()->route('filieres.show', $filiere)->with('success', 'Filière modifiée !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();

        return redirect()->route('filieres.index')->with('success', 'Filière supprimée !');
    }
}
