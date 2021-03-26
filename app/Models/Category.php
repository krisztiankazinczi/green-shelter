<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_uri',
        'text_location',
        'menu_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
