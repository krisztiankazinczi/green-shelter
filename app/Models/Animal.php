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
        'description',
        'animal_of_the_week',
        'adopted',
        'user_id',
        'animal_type_id',
        'menu_id',
    ];

    protected $casts = [
        'animal_of_the_week' => 'boolean',
        'adopted' => 'boolean'
    ];
    
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid()->toString();
            // $model->animal_of_the_week = false;
            $model->adopted = false;
        });
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function animalType()
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}
