<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\Departement;
use App\Models\Filiere;
use App\Models\Professeur;
use App\Models\Etudiant;

class TableauController extends Controller
{
    /**
     * Retourne les données paginées JSON pour le type demandé.
     *
     * @param Request $request
     * @param string $type
     * @return JsonResponse
     */
    public function getData(Request $request, string $type): JsonResponse
    {
        $map = [
            'departements' => Departement::class,
            'filieres'     => Filiere::class,
            'professeurs'  => Professeur::class,
            'etudiants'    => Etudiant::class,
        ];

        if (! array_key_exists($type, $map)) {
            return response()->json(['error' => 'Type invalide'], 400);
        }

        $modelClass = $map[$type];
        $page = (int) max(1, $request->query('page', 1));
        $cacheKey = "table-{$type}-page-{$page}";

        try {
            $paginator = Cache::remember($cacheKey, 30, function () use ($modelClass, $page) {
                $query = $modelClass::query();

                // eager load relations utiles pour afficher valeurs lisibles
                if ($modelClass === Filiere::class) {
                    $query->with('departement');
                } elseif ($modelClass === Etudiant::class) {
                    $query->with('filiere');
                }

                return $query->paginate(10, ['*'], 'page', $page);
            });

            // récupérer colonnes réelles depuis la table
            $instance = new $modelClass();
            $table = $instance->getTable();
            $rawColumns = Schema::getColumnListing($table);

            // retirer colonnes techniques et l'id primaire
            $filtered = array_values(array_filter($rawColumns, function ($c) {
                return ! in_array($c, ['id', 'created_at', 'updated_at']);
            }));

            // construire liste des colonnes affichées : remplacer xxx_id par xxx (relation lisible)
            $displayColumns = [];
            foreach ($filtered as $col) {
                if (str_ends_with($col, '_id')) {
                    $displayColumns[] = substr($col, 0, -3); // filiere_id -> filiere
                } else {
                    $displayColumns[] = $col;
                }
            }

            // s'assurer d'avoir des clés uniques (cas improbable mais sûr)
            $displayColumns = array_values(array_unique($displayColumns));

            // construire les lignes : retourner valeurs lisibles (relations -> nom si possible)
            $rows = [];
            foreach ($paginator->items() as $model) {
                $row = [];
                foreach ($filtered as $origCol) {
                    $displayKey = str_ends_with($origCol, '_id') ? substr($origCol, 0, -3) : $origCol;

                    // FK -> tenter d'afficher le "nom" de la relation si chargé
                    if (str_ends_with($origCol, '_id')) {
                        $relation = substr($origCol, 0, -3);
                        $related = null;

                        // relation comme méthode ou propriété
                        if (method_exists($model, $relation) || isset($model->{$relation})) {
                            $related = $model->{$relation} ?? null;
                        }

                        if (is_object($related)) {
                            // si l'objet a 'nom' ou 'name' utiliser cela, sinon tenter toString or id
                            if (isset($related->nom)) {
                                $row[$displayKey] = $related->nom;
                            } elseif (isset($related->name)) {
                                $row[$displayKey] = $related->name;
                            } elseif (isset($related->id)) {
                                $row[$displayKey] = $related->id;
                            } else {
                                $row[$displayKey] = (string) $related;
                            }
                        } else {
                            // fallback : afficher la valeur brute de la colonne FK (id)
                            $row[$displayKey] = $model->{$origCol} ?? null;
                        }

                        continue;
                    }

                    // colonne normale
                    $row[$displayKey] = $model->{$origCol} ?? null;
                }

                // garantir que row contient toutes les displayColumns (ordre stable)
                $ordered = [];
                foreach ($displayColumns as $colKey) {
                    $ordered[$colKey] = $row[$colKey] ?? null;
                }

                $rows[] = $ordered;
            }

            $response = [
                'columns' => $displayColumns,
                'data' => $rows,
                'pagination' => [
                    'current_page' => $paginator->currentPage(),
                    'last_page' => $paginator->lastPage(),
                    'per_page' => $paginator->perPage(),
                    'total' => $paginator->total(),
                    'next_page_url' => $paginator->nextPageUrl(),
                    'prev_page_url' => $paginator->previousPageUrl(),
                ],
            ];

            return response()->json($response);
        } catch (\Throwable $e) {
            Log::error('TableauController@getData error: '.$e->getMessage());
            return response()->json(['error' => 'Erreur serveur'], 500);
        }
    }
}
