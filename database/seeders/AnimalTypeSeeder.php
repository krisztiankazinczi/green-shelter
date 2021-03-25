<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AnimalType;

class AnimalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [ 
                'name' => 'Korcs',
                'description' => 'Some description'
            ],
            [ 
                'name' => 'Rottweiler',
                'description' => 'Some description'
            ],
            [ 
                'name' => 'Csivava',
                'description' => 'Some description'
            ],
            [ 
                'name' => 'Husky',
                'description' => 'Some description'
            ],
            [ 
                'name' => 'Golden Retriever',
                'description' => 'Some description'
            ],
        ];

        foreach ($types as $type) {
            AnimalType::create(array(
                'name' => $type['name'],
                'description' => $type['description'],
            ));
        }
    }
}
