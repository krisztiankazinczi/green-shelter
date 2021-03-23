<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = [
        'route',
        'name',
        'parent',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at'
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }
}
