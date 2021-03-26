<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [ 
                'filename' => 'dog1.jpg',
                'main' => true,
                'animal_id' => '0c5014c0-2f7f-4592-866e-36998fb18590'
            ],
            [ 
                'filename' => 'dog2.jpeg',
                'main' => false,
                'animal_id' => '0c5014c0-2f7f-4592-866e-36998fb18590'
            ],
            [ 
                'filename' => 'dog3.jpeg',
                'main' => false,
                'animal_id' => '0c5014c0-2f7f-4592-866e-36998fb18590'
            ],
            [ 
                'filename' => 'dog4.jpg',
                'main' => true,
                'animal_id' => '5d779a04-2670-4ad2-9a99-20c3cf89cc13'
            ],
            [ 
                'filename' => 'dog5.jpg',
                'main' => false,
                'animal_id' => '5d779a04-2670-4ad2-9a99-20c3cf89cc13'
            ],
            [ 
                'filename' => 'dog6.jpg',
                'main' => false,
                'animal_id' => '5d779a04-2670-4ad2-9a99-20c3cf89cc13'
            ],
            [ 
                'filename' => 'dog7.jpg',
                'main' => false,
                'animal_id' => '5d779a04-2670-4ad2-9a99-20c3cf89cc13'
            ],
            [ 
                'filename' => 'dog8.jpg',
                'main' => true,
                'animal_id' => '5bbec869-62a1-447f-b275-15b592543f46'
            ],
            [ 
                'filename' => 'dog9.jpg',
                'main' => false,
                'animal_id' => '5bbec869-62a1-447f-b275-15b592543f46'
            ],
            [ 
                'filename' => 'dog10.jpg',
                'main' => true,
                'animal_id' => 'f348348b-acac-4db2-9e0e-7734a3b84068'
            ],
            [ 
                'filename' => 'dog11.jpg',
                'main' => true,
                'animal_id' => 'f5bb1ad8-719c-48ab-9170-9804436a5827'
            ],
            [ 
                'filename' => 'dog12.jpeg',
                'main' => false,
                'animal_id' => 'f5bb1ad8-719c-48ab-9170-9804436a5827'
            ],
            [ 
                'filename' => 'dog13.jpg',
                'main' => false,
                'animal_id' => 'f5bb1ad8-719c-48ab-9170-9804436a5827'
            ],
            [ 
                'filename' => 'dog14.jpg',
                'main' => true,
                'animal_id' => '93cb30cc-4f2b-433c-8f0e-94085bae3d8c'
            ],
            [ 
                'filename' => 'dog15.jpg',
                'main' => false,
                'animal_id' => '93cb30cc-4f2b-433c-8f0e-94085bae3d8c'
            ],
            [ 
                'filename' => 'dog16.jpg',
                'main' => false,
                'animal_id' => '93cb30cc-4f2b-433c-8f0e-94085bae3d8c'
            ],
            [ 
                'filename' => 'dog17.jpg',
                'main' => true,
                'animal_id' => '85e3af03-e722-419e-9460-94bd0b6a3c4d'
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
