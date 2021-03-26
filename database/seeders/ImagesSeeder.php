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
                'main' => true
            ],
            [ 
                'filename' => 'dog2.jpeg',
                'main' => false
            ],
            [ 
                'filename' => 'dog3.jpeg',
                'main' => false
            ],
            [ 
                'filename' => 'dog4.jpg',
                'main' => true
            ],
            [ 
                'filename' => 'dog5.jpg',
                'main' => false
            ],
            [ 
                'filename' => 'dog6.jpg',
                'main' => false
            ],
            [ 
                'filename' => 'dog7.jpg',
                'main' => false
            ],
            [ 
                'filename' => 'dog8.jpg',
                'main' => true
            ],
            [ 
                'filename' => 'dog9.jpg',
                'main' => false
            ],
            [ 
                'filename' => 'dog10.jpg',
                'main' => true
            ],
            [ 
                'filename' => 'dog11.jpg',
                'main' => true
            ],
            [ 
                'filename' => 'dog12.jpeg',
                'main' => false
            ],
            [ 
                'filename' => 'dog13.jpg',
                'main' => false
            ],
            [ 
                'filename' => 'dog14.jpg',
                'main' => true
            ],
            [ 
                'filename' => 'dog15.jpg',
                'main' => false
            ],
            [ 
                'filename' => 'dog16.jpg',
                'main' => false
            ],
            [ 
                'filename' => 'dog17.jpg',
                'main' => true
            ],
        ];

        foreach ($images as $image) {
            Image::create(array(
                'filename' => $image['filename'],
                'main' => $image['main'],
            ));
        }
    }
}
