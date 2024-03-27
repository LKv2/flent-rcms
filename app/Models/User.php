<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'activation',
        'groupId'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'activation' => 'boolean',

    ];
    public function offices()
    {
        return $this->hasMany(Office::class,'agence_id');
    }
    public function locations()
    {
        return $this->hasMany(Location::class,'agence_id');
    }
    public function clients()
    {
        return $this->hasMany(Client::class,'agence_id');
    }
    public function cars()
    {
        return $this->hasMany(Car::class,'agence_id');
    }
    public function charges()
    {
        return $this->hasMany(Charge::class,'agence_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class,'agence_id');
    }
}
