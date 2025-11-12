<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ProfesseurController;
use App\Http\Controllers\TableauController;


Route::get('/', function () {
    return view('menu');
});

// Etudiant Routes
Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiants.index');
Route::get('/etudiants/create', [EtudiantController::class, 'create'])->name('etudiants.create');
Route::post('/etudiants', [EtudiantController::class, 'store'])->name('etudiants.store');
Route::get('/etudiants/{etudiant}', [EtudiantController::class, 'show'])->name('etudiants.show');
Route::get('/etudiants/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('etudiants.edit');
Route::put('/etudiants/{etudiant}', [EtudiantController::class, 'update'])->name('etudiants.update');
Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiants.destroy');

// Filiere Routes
Route::get('/filieres', [FiliereController::class, 'index'])->name('filieres.index');
Route::get('/filieres/create', [FiliereController::class, 'create'])->name('filieres.create');
Route::post('/filieres', [FiliereController::class, 'store'])->name('filieres.store');
Route::get('/filieres/{filiere}', [FiliereController::class, 'show'])->name('filieres.show');
Route::get('/filieres/{filiere}/edit', [FiliereController::class, 'edit'])->name('filieres.edit');
Route::put('/filieres/{filiere}', [FiliereController::class, 'update'])->name('filieres.update');
Route::delete('/filieres/{filiere}', [FiliereController::class, 'destroy'])->name('filieres.destroy');

// Departement Routes
Route::get('/departements', [DepartementController::class, 'index'])->name('departements.index');
Route::get('/departements/create', [DepartementController::class, 'create'])->name('departements.create');
Route::post('/departements', [DepartementController::class, 'store'])->name('departements.store');
Route::get('/departements/{departement}', [DepartementController::class, 'show'])->name('departements.show');
Route::get('/departements/{departement}/edit', [DepartementController::class, 'edit'])->name('departements.edit');
Route::put('/departements/{departement}', [DepartementController::class, 'update'])->name('departements.update');
Route::delete('/departements/{departement}', [DepartementController::class, 'destroy'])->name('departements.destroy');

// Professeur Routes
Route::get('/professeurs', [ProfesseurController::class, 'index'])->name('professeurs.index');
Route::get('/professeurs/create', [ProfesseurController::class, 'create'])->name('professeurs.create');
Route::post('/professeurs', [ProfesseurController::class, 'store'])->name('professeurs.store');
Route::get('/professeurs/{professeur}', [ProfesseurController::class, 'show'])->name('professeurs.show');
Route::get('/professeurs/{professeur}/edit', [ProfesseurController::class, 'edit'])->name('professeurs.edit');
Route::put('/professeurs/{professeur}', [ProfesseurController::class, 'update'])->name('professeurs.update');
Route::delete('/professeurs/{professeur}', [ProfesseurController::class, 'destroy'])->name('professeurs.destroy');

// Tableau Routes
Route::get('/tableau', function () {
    return view('tableau');
})->name('tableau');
Route::get('/data/{type}', [TableauController::class, 'getData']);