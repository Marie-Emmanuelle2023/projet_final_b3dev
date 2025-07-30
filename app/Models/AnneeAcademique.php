<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeAcademique extends Model
{
    /** @use HasFactory<\Database\Factories\AnneeAcademiqueFactory> */
    use HasFactory;

    protected $fillable = [
        'nom',
        'annee_id',
        'classe_id',
    ];

    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }


}
