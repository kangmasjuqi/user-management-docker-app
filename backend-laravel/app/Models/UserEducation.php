<?php
// app/Models/UserEducation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UserEducation extends Model
{
    use HasFactory;

    protected $table = 'user_educations';

    protected $fillable = [
        'user_id',
        'level',
        'year',
        'institution',
        'major',
        'gpa',
    ];

    protected static function booted()
    {
        static::created(function ($education) {
            Cache::forget("user:{$education->user_id}:with_educations");
        });

        static::updated(function ($education) {
            Cache::forget("user:{$education->user_id}:with_educations");
        });

        static::deleted(function ($education) {
            Cache::forget("user:{$education->user_id}:with_educations");
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}