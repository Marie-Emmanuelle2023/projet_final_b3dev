<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annee extends Model
{
    /** @use HasFactory<\Database\Factories\AnneeFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        'debut',
        'fin',
        'en_cours',
    ];
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}
