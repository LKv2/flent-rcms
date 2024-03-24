<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'phone',
        'adresse',
        'passport',
        'date_naissance',
        'nationalite',
        'ville',
        'cin',
        'permis',
        'file_input_C',
        'file_input_P',
        'file_input_Pass',
        'CDelivre_date',
        'PassDelivre_date',
        'CValide_date',
        'PassValide_date',
        'PDelivre_date',
        'PValide_date',
        'user'
    ];
    public function user()
    {
        $user=User::find($this->user);
        return $user;
    }
}

