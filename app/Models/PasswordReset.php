<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets'; // use the existing table
    public $timestamps = false; // usually this table doesn’t have created_at/updated_at
    protected $fillable = ['email', 'token', 'otp', 'created_at'];
}
