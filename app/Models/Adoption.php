<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;
class Adoption extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'animal_id',
        'status',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    } 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function filteredAdoptionsByDays($type, $days) {
        $date = Carbon::today()->subDays($days);
        if ($type == 'requested') {
            return $this->where('updated_at', '>=', $date)->count(); 
        } else {
            return $this->where('status', $type)->where('updated_at', '>=', $date)->count(); 
        }
    }

    public function allAdoptionsByType($type) {
        if ($type == 'requested') {
            return $this->count();
        } else {
            return $this->where('status', $type)->count();
        }
    }

    public function getDatesOfAdoptionRequests($type, $days) {
        $date = Carbon::today()->subDays($days);
        if ($type == 'requested') {
            return $this->where('updated_at', '>=', $date)->select('updated_at')->get();
        } else {
            return $this->where('status', $type)->where('updated_at', '>=', $date)->select('updated_at')->get(); 
        }
    }

}
