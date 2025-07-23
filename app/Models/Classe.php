<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    /** @use HasFactory<\Database\Factories\ClasseFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        'niveau_id'
    ];

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function etudiants()
    {
        return $this->hasMany(Etudiant::class);
    }

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }
}
