<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /** @use HasFactory<\Database\Factories\ModuleFactory> */
    use HasFactory;

    protected $fillable = [
        'nom'
    ];

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }

    public function professeurs()
    {
        return $this->belongsToMany(Professeur::class, 'professeur_modules', 'module_id', 'professeur_id');
    }
}
