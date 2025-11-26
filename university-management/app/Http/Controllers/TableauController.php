<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Filiere;
use App\Models\Professeur;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class TableauController extends Controller
{
    public function index()
    {
        return view('tableau.index');
    }

    public function getDepartements(Request $request)
    {
        $departements = Departement::paginate(10);
        return view('tableau.departements', compact('departements'));
    }

    public function getFilieres(Request $request)
    {
        $filieres = Filiere::paginate(10);
        return view('tableau.filieres', compact('filieres'));
    }

    public function getProfesseurs(Request $request)
    {
        $professeurs = Professeur::paginate(10);
        return view('tableau.professeurs', compact('professeurs'));
    }

    public function getEtudiants(Request $request)
    {
        $etudiants = Etudiant::paginate(10);
        return view('tableau.etudiants', compact('etudiants'));
    }
}