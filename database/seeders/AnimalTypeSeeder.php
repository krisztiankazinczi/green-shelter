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
                'description' => 'Some description',
                'image_uri' => 'types/korcs.jpg'
            ],
            [ 
                'name' => 'Rottweiler',
                'description' => 'Some description',
                'image_uri' => 'types/rottweiler.jpg'
            ],
            [ 
                'name' => 'Csivava',
                'description' => 'Some description',
                'image_uri' => 'types/csivava.jpg'
            ],
            [ 
                'name' => 'Husky',
                'description' => 'Some description',
                'image_uri' => 'types/husky.jpg'
            ],
            [ 
                'name' => 'Golden Retriever',
                'description' => 'Some description',
                'image_uri' => 'types/golden_retriever.jpg'
            ],
            [ 
                'name' => 'Tacskó',
                'description' => 'Some description',
                'image_uri' => 'types/tacsko.jpg'
            ],
        ];

        foreach ($types as $type) {
            AnimalType::create(array(
                'name' => $type['name'],
                'description' => $type['description'],
                'image_uri' => $type['image_uri'],
            ));
        }
    }
}
