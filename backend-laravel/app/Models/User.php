<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements JWTSubject 
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'gender',
        'email',
        'phone',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::updated(function ($user) {
            Cache::forget("user:{$user->id}:with_educations");
        });

        static::deleted(function ($user) {
            Cache::forget("user:{$user->id}:with_educations");
        });
    }

    public function educations()
    {
        return $this->hasMany(UserEducation::class);
    }

    /**
     * Required by JWTSubject
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // usually the 'id'
    }

    /**
     * Required by JWTSubject
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
