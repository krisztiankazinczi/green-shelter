<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'read',
        'archived',
        'from_id',
        'to_id',
    ];

    protected $casts = [
        'read' => 'boolean',
        'archived' => 'boolean',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid()->toString();
        });
    }
}
