<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Agencie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'fname',
        'lname',
        'phone',
        'date_naissance',
        'file_input_C',
        'cin',
        'adresse',
        'groupId',
        'online',
        'user'
    ];
    public function cars()
    {
        return $this->hasMany(Car::class,'agence_id');
    }
    public function charges()
    {
        return $this->hasMany(Charge::class,'agence_id');
    }
    public function offices()
    {
        return $this->hasMany(Office::class,'agence_id');
    }
    public function payements()
    {
        return $this->hasMany(Payment::class,'agence_id');
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class,'agence_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class,'agence_id');
    }
    public function locations()
    {
        return $this->hasMany(Location::class,'agence_id');
    }
    public function clients()
    {
        return $this->hasMany(Client::class,'agence_id');
    }
    public function user()
    {
        $user = User::find($this->user);
        return $user;
    }
    function Totalbookings()
    {
        $total=0.0;
        foreach ($this->bookings as $value) {
            $total += floatval($value->amount);
        }
        return $total;
    }
    function Totalunpayed()
    {
        $total=0.0;
        foreach ($this->bookings as $value) {
            $total += floatval($value->reste());
        }
        return $total;
    }
    
    function Totalcharges()
    {
        $total=0.0;
        foreach ($this->charges as $value) {
            $total += floatval($value->amount);
        }
        return $total;
    }
    function Totalpayements()
    {
        $total=0.0;
        foreach ($this->payements as $value) {
            $total += floatval($value->amount);
        }
        return $total;
    }
    function TotalProfite()
    {
        $total=$this->Totalbookings()-$this->Totalcharges();
        return $total;
    }
}
