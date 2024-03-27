<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'date',
        'type',
        'agence_id'
    ];

    // Define relationships, if any
    // For example, a task belongs to a user
    public function agencie()
    {
        return $this->belongsTo(Agencie::class, 'agence_id');
    }
    public function user()
    {
        if ($this->type==='Car Task') {
            return $this->belongsTo(Car::class, 'user_id');
        } elseif ($this->type==='Booking Task') {
            return $this->belongsTo(Booking::class, 'user_id');
        }else{
            return null;
        }
        
    }
}
