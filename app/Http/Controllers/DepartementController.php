<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departements = Departement::withCount('filieres')->orderBy('created_at', 'desc')->paginate(10);

        return view('departements.index', ['departements' => $departements]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departements.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|integer|min:0',
        ]);

        Departement::create($validated);

        return redirect()->route('departements.index')->with('success', 'Departement créé !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Departement $departement)
    {
        return view('departements.show', ['departement' => $departement]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departement $departement)
    {
        return view('departements.form', ['departement' => $departement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Departement $departement)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'capacite' => 'required|integer|min:0',
        ]);

        $departement->update($validated);

        return redirect()->route('departements.show', $departement)->with('success', 'Departement modifié !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();

        return redirect()->route('departements.index')->with('success', 'Departement supprimé !');
    }
}
