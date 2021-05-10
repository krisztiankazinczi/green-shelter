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
        return $this->where('status', 'adopted');
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

    public function rejectedAdoptions() {
        return $this->where('status', 'rejected');
    }

    public function rejectedAdoptionsLastWeek() {
        $date = Carbon::today()->subDays(7);
        return $this->rejectedAdoptions()->where('updated_at', '>=', $date)->count();
    }

    public function rejectedAdoptionsLastMonth() {
        $date = Carbon::today()->subDays(30);
        return $this->rejectedAdoptions()->where('updated_at', '>=', $date)->count();
    }

    public function rejectedAdoptionsLastYear() {
        $date = Carbon::today()->subDays(365);
        return $this->rejectedAdoptions()->where('updated_at', '>=', $date)->count();
    }

    public function rejectedAdoptionsAllTime() {
        return $this->rejectedAdoptions()->count();
    }

    public function requestedAdoptionsLastWeek() {
        $date = Carbon::today()->subDays(7);
        return $this->where('updated_at', '>=', $date)->count();
    }

    public function requestedAdoptionsLastMonth() {
        $date = Carbon::today()->subDays(30);
        return $this->where('updated_at', '>=', $date)->count();
    }

    public function requestedAdoptionsLastYear() {
        $date = Carbon::today()->subDays(365);
        return $this->where('updated_at', '>=', $date)->count();
    }

    public function requestedAdoptionsAllTime() {
        return $this->count();
    }

}
