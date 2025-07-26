<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    /** @use HasFactory<\Database\Factories\NiveauFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }

    public function coordinateurs()
    {
        return $this->belongsToMany(Coordinateur::class, 'coordinateur_niveau')
            ->withPivot('annee_academique_id')
            ->withTimestamps();
    }
}
