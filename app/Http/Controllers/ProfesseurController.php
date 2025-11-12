<?php

namespace App\Http\Controllers;

use App\Models\Professeur;
use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professeurs = Professeur::orderBy('created_at', 'desc')->paginate(10);

        return view('professeurs.index', ['professeurs' => $professeurs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('professeurs.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'salaire' => 'required|numeric|min:0',
            'prime' => 'required|numeric|min:0',
        ]);

        Professeur::create($validated);

        return redirect()->route('professeurs.index')->with('success', 'Professeur créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Professeur $professeur)
    {
        return view('professeurs.show', ['professeur' => $professeur]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professeur $professeur)
    {
        return view('professeurs.form', ['professeur' => $professeur]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professeur $professeur)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'grade' => 'required|string|max:255',
            'salaire' => 'required|numeric|min:0',
            'prime' => 'required|numeric|min:0',
        ]);

        $professeur->update($validated);

        return redirect()->route('professeurs.show', $professeur)->with('success', 'Professeur modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Professeur $professeur)
    {
        $professeur->delete();

        return redirect()->route('professeurs.index')->with('success', 'Professeur supprimé !');
    }
}
