<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'agence_id', 'office_id'
    ];
    public function agencie()
    {
        return $this->belongsTo(User::class, 'agence_id');
    }
    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }
}
