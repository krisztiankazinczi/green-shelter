<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adoption = DB::table('adoptions')->where('status', 'adopted')->first();

        $reviews = [
            [
                'rating' => 5,
                'review' => 'Nagyon jó amit csinálnak, hogy napi szinten állatokon segítenek! Szükség van ilyen emberekre, és azokra akik támogatni tudják őket ebben!',
                'adoption_id' => $adoption->id,
            ]
        ];

        foreach ($reviews as $review) {
            Review::create(array(
                'rating' => $review['rating'],
                'review' => $review['review'],
                'adoption_id' => $review['adoption_id'],
            ));
        }
    }
}
