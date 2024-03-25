<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'city', 'fixe', 'phone', 'addressLine1', 'addressLine2','agence_id','user'
    ];

    public function agencie()
    {
        return $this->belongsTo(User::class, 'agence_id');
    }
    public function user()
    {
        $user = User::find($this->user);
        return $user;
    }
}
