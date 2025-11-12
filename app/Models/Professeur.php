<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professeur extends Model
{
    protected $fillable = [ 'nom', 'prenom', 'grade', 'salaire', 'prime'];

    
    /** @use HasFactory<\Database\Factories\ProfesseurFactory> */
    use HasFactory;
}
