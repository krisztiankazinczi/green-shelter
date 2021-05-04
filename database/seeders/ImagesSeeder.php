<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Animal;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animal1 = Animal::where('title', 'Elveszett leonbergit keresi szerető családja!')->first();
        $animal2 = Animal::where('title', 'Buksit keresem!')->first();
        $animal3 = Animal::where('title', 'Szilveszter óta keressük Micit')->first();
        $animal4 = Animal::where('title', 'Elveszett szeretett kiskutyám!')->first();
        $animal5 = Animal::where('title', 'Pénteken (07.22.) délután eltűnt Mogyoródon a kutyusunk Szuszi')->first();
        $animal6 = Animal::where('title', '08.12-én elszökött Szotyi!')->first();
        $animal7 = Animal::where('title', 'Pehely')->first();
        $animal8 = Animal::where('title', 'Gizike')->first();



        $images = [
            [ 
                'filename' => 'leonbergi.jpg',
                'main' => true,
                'animal_id' => $animal1->id
            ],
            [ 
                'filename' => 'dog2.jpeg',
                'main' => false,
                'animal_id' => $animal1->id
            ],
            [ 
                'filename' => 'dog3.jpeg',
                'main' => false,
                'animal_id' => $animal1->id
            ],
            [ 
                'filename' => 'dog4.jpg',
                'main' => true,
                'animal_id' => $animal2->id
            ],
            [ 
                'filename' => 'dog5.jpg',
                'main' => false,
                'animal_id' => $animal2->id
            ],
            [ 
                'filename' => 'dog6.jpg',
                'main' => false,
                'animal_id' => $animal2->id
            ],
            [ 
                'filename' => 'dog7.jpg',
                'main' => false,
                'animal_id' => $animal2->id
            ],
            [ 
                'filename' => 'dog8.jpg',
                'main' => true,
                'animal_id' => $animal3->id
            ],
            [ 
                'filename' => 'dog9.jpg',
                'main' => false,
                'animal_id' => $animal3->id
            ],
            [ 
                'filename' => 'dog10.jpg',
                'main' => true,
                'animal_id' => $animal4->id
            ],
            [ 
                'filename' => 'dog11.jpg',
                'main' => true,
                'animal_id' => $animal5->id
            ],
            [ 
                'filename' => 'dog12.jpeg',
                'main' => false,
                'animal_id' => $animal5->id
            ],
            [ 
                'filename' => 'dog13.jpg',
                'main' => false,
                'animal_id' => $animal5->id
            ],
            [ 
                'filename' => 'szotyi.jpeg',
                'main' => true,
                'animal_id' => $animal6->id
            ],
            [ 
                'filename' => 'dog15.jpg',
                'main' => false,
                'animal_id' => $animal6->id
            ],
            [ 
                'filename' => 'dog16.jpg',
                'main' => false,
                'animal_id' => $animal6->id
            ],
            [ 
                'filename' => 'pehely.jpg',
                'main' => true,
                'animal_id' => $animal7->id
            ],
            [ 
                'filename' => 'gizike.jpg',
                'main' => true,
                'animal_id' => $animal8->id
            ],
        ];

        foreach ($images as $image) {
            Image::create(array(
                'filename' => $image['filename'],
                'main' => $image['main'],
                'animal_id' => $image['animal_id'],
            ));
        }
    }
}
