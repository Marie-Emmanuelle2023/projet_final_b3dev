<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statut extends Model
{
    /** @use HasFactory<\Database\Factories\StatutFactory> */
    use HasFactory;

    protected $fillable = [
        'libelle'
    ];

    public function presences()
    {
        return $this->hasMany(Presence::class);
    }


}
