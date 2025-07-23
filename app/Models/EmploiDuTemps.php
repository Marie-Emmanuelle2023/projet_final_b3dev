<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmploiDuTemps extends Model
{
    /** @use HasFactory<\Database\Factories\EmploiDuTempsFactory> */
    use HasFactory;

    protected $fillable = [
        'classe_id'
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function seances()
    {
        return $this->hasMany(Seance::class);
    }
}
