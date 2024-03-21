<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque',
        'name',
        'year',
        'front_image',
        'back_image',
        'interior_image',
        'exterior_image',
    ];

    public function CarBrand()
    {
        return $this->belongsTo(Marque::class, 'marque');
    }
}
