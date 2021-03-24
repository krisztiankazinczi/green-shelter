<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title' => 'Gazdára váró kutyák',
                'description' => 'Folyamatosan frissítjük az oldalunkat, mégis a személyes látogatást javasoljuk a felelosségteljes kiválasztáshoz.
                Nagyon szeretnénk, ha a kutyáink sorsa jóra fordulna és szerető családra találnának. A képekre kattintva nagyobb méretben, külön ablakban megtekintheti őket.',
                'image_uri' => 'images/dog1.jpg',
                'menu_id' => 3
            ],
            [
                'title' => 'Elveszett kedvencek',
                'description' => 'Talált és elveszett kutyákról szívesen közlünk információkat, ha a elérhetőségünkre elküldi a hirdetés szövegét és egy fényképet.

                Kérjük, ha már nem aktuális, értesítsenek minket!',
                'image_uri' => 'images/dog2.jpeg',
                'menu_id' => 5
            ],
            [
                'title' => 'Talált kedvencek',
                'description' => 'Talált és elveszett kutyákról szívesen közlünk információkat, ha a elérhetőségünkre elküldi a hirdetés szövegét és egy fényképet.

                Kérjük, ha már nem aktuális, értesítsenek minket!',
                'image_uri' => 'images/dog3.jpeg',
                'menu_id' => 7
            ],
        ];

        foreach ($categories as $category) {
            Category::create(array(
                'title' => $category['title'],
                'description' => $category['description'],
                'image_uri' => $category['image_uri'],
                'menu_id' => $category['menu_id']
            ));
        }

    }
}
