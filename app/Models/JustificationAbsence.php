<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JustificationAbsence extends Model
{
    /** @use HasFactory<\Database\Factories\JustificationAbsenceFactory> */
    use HasFactory;

    protected $fillable = [
        'motif',
        'preuve',
        'date',
        'etudiant_id',
        'presence_id'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    public function presence()
    {
        return $this->belongsTo(Presence::class);
    }
    
}
