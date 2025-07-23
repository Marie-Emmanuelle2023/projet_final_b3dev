<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentEtudiant extends Model
{
    /** @use HasFactory<\Database\Factories\ParentEtudiantFactory> */
    use HasFactory;

    protected $fillable = [
        'parent_model_id',
        'etudiant_id'
    ];

    public function parentModel()
    {
        return $this->belongsTo(ParentModel::class);
    }
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

}
