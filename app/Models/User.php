<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'bio',
        'avatar_uri'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likesById($animal_id)
    {
        return $this->likes()
            ->where('animal_id', $animal_id)
            ->where('user_id', $this->id)
            ->first();
    }

    public function messages(){
        return $this->hasMany(Message::class, 'to_id');
    }

    public function unreadMessages()
    {
        return $this->messages()
            ->where('read', false)
            ->where('archived', false)
            ->where('inTrash', false)
            ->count();
    }
}
