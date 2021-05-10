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

    public function adoptionsWithAnimalAndUser() {
        return $this->with('animal', 'user');
    }

    public function adoptions() {
        return $this->with('animal', 'user')->where('status', 'adopted');
    }

    public function adoptionsLastWeek() {
        $date = Carbon::today()->subDays(7);
        return $this->adoptions()->where('updated_at', '>=', $date)->count();
    }

    public function adoptionsLastMonth() {
        $date = Carbon::today()->subDays(30);
        return $this->adoptions()->where('updated_at', '>=', $date)->count();
    }

    public function adoptionsLastYear() {
        $date = Carbon::today()->subDays(365);
        return $this->adoptions()->where('updated_at', '>=', $date)->count();
    }

    public function adoptionsAllTime() {
        return $this->adoptions()->count();
    }

}
