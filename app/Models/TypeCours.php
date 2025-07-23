<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCours extends Model
{
    /** @use HasFactory<\Database\Factories\TypeCoursFactory> */
    use HasFactory;

    protected $fillable = [
        'nom'
    ];

    public function seances()
    {
        return $this->hasMany(Seance::class, 'typecours_id');
    }
}
