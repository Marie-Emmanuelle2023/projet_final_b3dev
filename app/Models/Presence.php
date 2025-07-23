<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    /** @use HasFactory<\Database\Factories\PresenceFactory> */
    use HasFactory;

    protected $fillable = [
        'seance_id',
        'etudiant_id',
        'statut_id'
    ];

    public function seance()
    {
        return $this->belongsTo(Seance::class);
    }

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function statut()
    {
        return $this->belongsTo(Statut::class);
    }

    public function justification()
    {
        return $this->hasOne(JustificationAbsence::class);
    }
}
