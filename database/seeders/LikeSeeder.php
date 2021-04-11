<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Like;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animal1 = DB::table('animals')->select('id')->first();
        $animal2 = DB::table('animals')->select('id')->skip(1)->first();
        $animal3 = DB::table('animals')->select('id')->skip(2)->first();
        $animal4 = DB::table('animals')->select('id')->skip(3)->first();

        $likes = [
            [
                'user_id' => 1,
                'animal_id' => $animal1->id,
            ],
            [
                'user_id' => 2,
                'animal_id' => $animal1->id,
            ],
            [
                'user_id' => 3,
                'animal_id' => $animal1->id,
            ],
            [
                'user_id' => 1,
                'animal_id' => $animal2->id,
            ],
            [
                'user_id' => 2,
                'animal_id' => $animal2->id,
            ],
            [
                'user_id' => 4,
                'animal_id' => $animal3->id,
            ],
            [
                'user_id' => 5,
                'animal_id' => $animal3->id,
            ],
            [
                'user_id' => 1,
                'animal_id' => $animal4->id,
            ],
            [
                'user_id' => 2,
                'animal_id' => $animal4->id,
            ],
            [
                'user_id' => 3,
                'animal_id' => $animal4->id,
            ],
            [
                'user_id' => 4,
                'animal_id' => $animal4->id,
            ],
        ];

        foreach ($likes as $like) {
            Like::create(array(
                'user_id' => $like['user_id'],
                'animal_id' => $like['animal_id'],
            ));
        }
    }
}
