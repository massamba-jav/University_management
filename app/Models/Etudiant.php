<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = [ 'nom', 'prenom', 'date_naissance', 'lieu_naissance', 'filiere_id'];


    /** @use HasFactory<\Database\Factories\EtudiantFactory> */
    use HasFactory;

    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
}
