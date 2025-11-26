<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Etudiant;
use App\Models\Professeur;
use App\Models\Filiere;
use App\Models\Departement;

class TableauController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'etudiants');
        $perPage = (int) $request->get('per_page', 10);
        $sortBy = $request->get('sort', 'id');
        $sortDir = $request->get('dir', 'asc');

        // Map type to model and columns
        $modelMap = [
            'etudiants' => [
                'model' => Etudiant::class,
                'columns' => ['id', 'nom', 'prenom', 'date_naissance', 'lieu_naissance', 'filiere_id']
            ],
            'professeurs' => [
                'model' => Professeur::class,
                'columns' => ['id', 'nom', 'prenom', 'grade', 'salaire', 'prime']
            ],
            'filieres' => [
                'model' => Filiere::class,
                'columns' => ['id','nom', 'droit_inscription', 'mensualite', 'departement_id']
            ],
            'departements' => [
                'model' => Departement::class,
                'columns' => ['id','nom', 'capacite']
            ]
        ];

        // Default to etudiants if type invalid
        if (!isset($modelMap[$type])) {
            $type = 'etudiants';
        }

        $config = $modelMap[$type];
        $model = $config['model'];
        $columns = $config['columns'];

        // Build query
        $query = $model::query();

        // Apply sorting
        if (in_array($sortBy, $columns)) {
            $query->orderBy($sortBy, $sortDir);
        } else {
            $query->orderBy('id', 'asc');
        }

        // Paginate
        $items = $query->paginate($perPage);

        return view('tableau', [
            'type' => $type,
            'columns' => $columns,
            'items' => $items
        ]);
    }
}