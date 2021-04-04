<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;
use App\Models\Adoption;


class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animal1 = Animal::where('title', 'Buksit keresem!')->first();
        $animal2 = Animal::where('title', 'Szilveszter óta keressük Micit')->first();
        $animal3 = Animal::where('title', 'Elveszett szeretett kiskutyám!')->first();
        $animal3->adopted = true;
        $animal3->save();

        $adoptions = [
            [
                'user_id' => 1,
                'animal_id' => $animal1->id,
            ],
            [
                'user_id' => 2,
                'animal_id' => $animal2->id,
            ],
            [
                'user_id' => 3,
                'animal_id' => $animal3->id,
                'status' => 'adopted'
            ],
        ];

        foreach ($adoptions as $adoption) {
            if (array_key_exists("status", $adoption)) {
                Adoption::create(array(
                    'user_id' => $adoption['user_id'],
                    'animal_id' => $adoption['animal_id'],
                    'status' => $adoption['status']
                ));
            } else {
                Adoption::create(array(
                    'user_id' => $adoption['user_id'],
                    'animal_id' => $adoption['animal_id'],
                ));
            }
        }
    }
}
