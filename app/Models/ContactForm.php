<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class ContactForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'read',
        'completed'
    ];

    protected $cast = [
        'read' => 'boolean',
        'completed' => 'boolean',
    ];

    public function filteredMessagesByDays($days) {
        $date = Carbon::today()->subDays($days);
        return $this->where('created_at', '>=', $date)->count(); 
    }

    public function allMessages() {
        return $this->count();
    }

    public function getDatesOfMessages($days) {
        $date = Carbon::today()->subDays($days);
        return $this->where('updated_at', '>=', $date)->select('created_at')->get();
    }
}
