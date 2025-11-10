<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Kolom yang bisa diisi (mass assignment).
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'alamat',
        'no_hp',
        'role',
    ];

    /**
     * Kolom yang disembunyikan saat model dikonversi jadi array/json.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom yang otomatis dikonversi tipe data.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
