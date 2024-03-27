<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Charge extends Model
{
    use HasFactory;
    protected $fillable = ['type','description', 'amount', 'date','agence_id','car'];
    public function agencie()
    {
        return $this->belongsTo(Agencie::class, 'agence_id');
    }
    public function car()
    {
        return $this->belongsTo(Car::class, 'car');
    }
}
