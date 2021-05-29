<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menu_dog = DB::table('menus')->where('route', '=', 'dogs')->select('id')->first();

        $categories = [
            [
                'description' => 'Folyamatosan frissítjük az oldalunkat, mégis a személyes látogatást javasoljuk a felelosségteljes kiválasztáshoz.
                Nagyon szeretnénk, ha a kutyáink sorsa jóra fordulna és szerető családra találnának. A képekre kattintva nagyobb méretben, külön ablakban megtekintheti őket.',
                'image_uri' => 'dog1.jpg',
                'menu_id' => $menu_dog->id,
                'text_location' => 'left'
            ],
            [
                'description' => 'Macskak macskak. Folyamatosan frissítjük az oldalunkat, mégis a személyes látogatást javasoljuk a felelosségteljes kiválasztáshoz.
                Nagyon szeretnénk, ha a kutyáink sorsa jóra fordulna és szerető családra találnának. A képekre kattintva nagyobb méretben, külön ablakban megtekintheti őket.',
                'image_uri' => 'cats1.jpg',
                'menu_id' => 5,
                'text_location' => 'left'
            ],
            [
                'description' => 'Talált és elveszett kutyákról szívesen közlünk információkat, ha a elérhetőségünkre elküldi a hirdetés szövegét és egy fényképet.

                Kérjük, ha már nem aktuális, értesítsenek minket!',
                'image_uri' => 'dog2.jpeg',
                'menu_id' => 7,
                'text_location' => 'right'
            ],
            [
                'description' => 'Talált és elveszett kutyákról szívesen közlünk információkat, ha a elérhetőségünkre elküldi a hirdetés szövegét és egy fényképet.

                Kérjük, ha már nem aktuális, értesítsenek minket!',
                'image_uri' => 'dog3.jpeg',
                'menu_id' => 9,
                'text_location' => 'right'
            ],
            [
                'description' => 'Lakossagi hirdetesek blablabla',
                'image_uri' => 'dog2.jpeg',
                'menu_id' => 11,
                'text_location' => 'right'
            ],
            [
                'description' => 'Folyamatosan frissítjük az oldalunkat, kérjük küldjék el e-mailcímünkre sikeres örökbefogadásaik képes-szöveges beszámolóikat!

                Nagyon örülünk a sikeres örökbefogadásoknak!',
                'image_uri' => 'kep9.png',
                'menu_id' => 14,
                'text_location' => 'left'
            ],
            [
                'description' => 'Kepgaleria - nezelodj batran es ha megtetszik az egyik nezd meg a hirdetest',
                'image_uri' => 'dog2.jpeg',
                'menu_id' => 15,
                'text_location' => 'left'
            ],
        ];

        foreach ($categories as $category) {
            Category::create(array(
                'description' => $category['description'],
                'image_uri' => $category['image_uri'],
                'menu_id' => $category['menu_id'],
                'text_location' => $category['text_location']
            ));
        }

    }
}
