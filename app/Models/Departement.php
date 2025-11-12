<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [ 'nom', 'capacite'];

    
    /** @use HasFactory<\Database\Factories\DepartementFactory> */
    use HasFactory;

    public function filieres()
    {
        return $this->hasMany(Filiere::class);
    }
}
