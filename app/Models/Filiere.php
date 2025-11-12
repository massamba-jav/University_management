<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    protected $fillable = [ 'nom', 'droit_inscription', 'mensualite', 'departement_id'];


    /** @use HasFactory<\Database\Factories\FiliereFactory> */
    use HasFactory;

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }
    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }
}
