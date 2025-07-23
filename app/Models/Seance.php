<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seance extends Model
{
    /** @use HasFactory<\Database\Factories\SeanceFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'salle',
        'type_cours_id',
        'classe_id',
        'emploi_du_temps_id',
        'module_id'
    ];

    public function typeCours()
    {
        return $this->belongsTo(TypeCours::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function emploiDuTemps()
    {
        return $this->belongsTo(EmploiDuTemps::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    
    public function presences()
    {
        return $this->hasMany(Presence::class);
    }
}
