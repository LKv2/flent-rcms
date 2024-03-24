<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    use HasFactory;
    protected $fillable = [
        'marque_id',
        'name',
        'year',
        'front_image',
        'back_image',
        'interior_image',
        'exterior_image',
    ];

    public function marque()
    {
        return $this->belongsTo(Marque::class, 'marque_id');
    }
}
