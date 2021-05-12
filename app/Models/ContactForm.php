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

    public function getDatesOfMessages($type, $days) {
        $date = Carbon::today()->subDays($days);
        if ($type == 'all') {
            return $this->where('updated_at', '>=', $date)->select('created_at')->get();
        } elseif ($type == 'unread') {
            return $this->where('updated_at', '>=', $date)->where('read', false)->select('created_at')->get();
        } elseif ($type == 'uncomplete') {
            return $this->where('updated_at', '>=', $date)->where('completed', false)->select('created_at')->get();
        } elseif ($type == 'completed') {
            return $this->where('updated_at', '>=', $date)->where('completed', true)->select('created_at')->get();
        }
    }

    public function getUnreadMessagesCount() {
        return $this->where('read', false)->count(); 
    }

    public function getUncompleteMessagesCount() {
        return $this->where('completed', false)->count(); 
    }

    public function getCompletedMessagesCount() {
        return $this->where('completed', true)->count(); 
    }

    public function getMessagesByType($type, $days) {
        if ($type == 'all') {
            $date = Carbon::today()->subDays($days);
            return $this->where('updated_at', '>=', $date)->orderBy('created_at', 'DESC')->get();
        } elseif ($type == 'unread') {
            return $this->where('read', false)->orderBy('created_at', 'DESC')->get();
        } elseif ($type == 'uncomplete') {
            return $this->where('completed', false)->orderBy('created_at', 'DESC')->get();
        } elseif ($type == 'completed') {
            return $this->where('completed', true)->orderBy('created_at', 'DESC')->get();
        }
    }
}
