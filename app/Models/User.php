<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int,string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo', // profile photo
        'email_otp', // hashed otp
        'email_otp_expires_at', // expiry
        // Newly added fields
        'phone_number',
        'short_bio',
        'address',
        'work_info',
        'operate_truck',
        'dot_license_file',
        'dot_verified',
        'height',
        'height_unit',
        'weight',
        'weight_unit',
        'gender',
        'race',
        'sexual_preferences',
        'hiv_status',
        'dob',
        'relationship_status',
        'social_links',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int,string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_otp', // keep hashed otp hidden
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'email_otp_expires_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Accessor for profile photo URL
     */
    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo
            ? asset('storage/' . $this->profile_photo)
            : asset('backend/assets/images/avatar/avatar-12.jpg'); // fallback if no photo
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
