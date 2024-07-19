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
    ];
    public function userDetails()
    {
        return $this->hasOne(UserDetails::class)->select('id', 'user_id', 'govt_id', 'govt_id_no', 'skills', 'hobbies', 'about_me', 'achievements', 'current_address', 'permanent_address', 'phone', 'emergency_contact','gender');
    }
    public function educationDetails()
    {
        return $this->hasMany(EducationDetails::class)->select('id', 'user_id', 'degree', 'institute', 'start_year', 'end_year');
    }
    public function certification()
    {
        return $this->hasMany(Certification::class)->select('id', 'user_id', 'certification', 'institute', 'year', 'score');
    }
}
