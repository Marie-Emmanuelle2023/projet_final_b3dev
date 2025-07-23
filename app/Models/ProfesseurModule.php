<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesseurModule extends Model
{
    /** @use HasFactory<\Database\Factories\ProfesseurModuleFactory> */
    use HasFactory;

    protected $fillable = [
        'professeur_id',
        'module_id'
    ];

    public function professeur()
    {
        return $this->belongsTo(Professeur::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

}
