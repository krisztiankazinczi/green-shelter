<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Animal extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = [
        'title',
        'title',
        'description',
        'dog_of_the_week',
        'adopted',
        'image_ids',
        'category_id',
        'user_id',
        'animal_type_id',
        'menu_id',
    ];

    protected $casts = [
        'dog_of_the_week' => 'boolean',
        'adopted' => 'boolean',
        'image_ids' => 'array'
    ];
    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid()->toString();
            $model->dog_of_the_week = false;
            $model->adopted = false;
        });
    }

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

    public function animalType()
    {
        return $this->hasOne(AnimalType::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
