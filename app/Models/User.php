<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function fans()
    {
        return $this->belongsToMany(User::class, 'user_fan', 'user_id', 'fan_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'user_fan', 'fan_id', 'user_id');
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
