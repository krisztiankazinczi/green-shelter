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
        'created_at',
        'updated_at'
    ];

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
