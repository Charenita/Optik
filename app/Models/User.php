<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password', 'umur', 'jenis_kelamin', 'role'
    ];

    protected $hidden = ['password', 'remember_token'];

    public function diagnosas()
    {
        return $this->hasMany(Diagnosa::class);
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
