<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinateur extends Model
{
    /** @use HasFactory<\Database\Factories\CoordinateurFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function niveaux()
    {
        return $this->belongsToMany(Niveau::class, 'coordinateur_niveau')
            ->withPivot('annee_academique_id')
            ->withTimestamps();
    }
}
