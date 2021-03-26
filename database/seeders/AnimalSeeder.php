<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animals = [
            [
                'title' => 'Elveszett leonbergit keresi szerető családja!',
                'description' => 'Március 23-án eltűnt Ócsáról nagyon nagy méretű (kb. 75-80 cm marmagasságú lehet), leonbergi jellegű, chippelt, barna kan kutyusunk. Vélhetően tüzelő szukák után indult.\n\n
                Borisz névre hallgat, nagyon szerettük őt, a megtalálónak pénzjutalmat adnék.\n\n
                Csatoltam fotót róla, kérem, ha bármit tudnak, értesítsenek!\n\n
                Köszönettel:\n\n
                Dr. Gaál Ágnes\n
                06304339384',
                'image_ids' => json_encode(array(1, 2, 3)),
                'category_id' => 1,
                'user_id' => 1,
                'animal_type_id' => '1d75d107-d7ad-4dbb-b450-20c01bd1acd5',
                'menu_id' => 3,
            ],
            [
                'title' => 'Buksit keresem!',
                'description' => 'Tavaly Máriakéméndről tűnt el. Azóta nem tudok sajnos róla semmit.\n
                \nBuksi névre hallgat. Chippel rendelkezik. Ivartalanított kan.3 éves lesz májusba\n\n
                elérhetőségem: 06705977263',
                'image_ids' => json_encode(array(4, 5, 6, 7)),
                'category_id' => 1,
                'user_id' => 2,
                'animal_type_id' => '84101b2e-c7c3-40f0-b8c7-9315e3b62805',
                'menu_id' => 3,
            ],
            [
                'title' => 'Szilveszter óta keressük Micit',
                'description' => 'Szilveszter óta keressük Micit, de nem adjuk fel!\n
                Csatolok róla egy képet,többen látták de mi nem találtuk meg.\n
                Ezen a mobilszámon bármikor elérhető van, minden információ érdekel esetleges legrosszabb hír is. Köszönöm!\n\n
                Kovács Krisztina\n
                06309987521\n
                krisztuuka@citromail.hu',
                'image_ids' => json_encode(array(8, 9)),
                'category_id' => 1,
                'user_id' => 3,
                'animal_type_id' => '0cfe2c0e-1b19-42ad-9531-14aaaf724e93',
                'menu_id' => 3,
            ],
            [
                'title' => 'Elveszett szeretett kiskutyám!',
                'description' => 'Elveszett szeretett kiskutyám aug.27-én a délutáni órákban Szigetszentmiklósról, a Szőlő közből. Chip van benne (chipszám: 900032001610546), félénk, kis termetű, kan, fekete-fehér harlekin uszkár. Gucci névre hallgat.\n
                MAGAS PÉNZ JUTALOM A BECSÜLETES MEGTALÁLÓNAK VAGY NYOMRAVEZETŐNEK!\n\n
                Hohl Bernadett\n
                06203934625 vagy 06209622373\n
                detti2310@gmail.com',
                'image_ids' => json_encode(array(10)),
                'category_id' => 1,
                'user_id' => 2,
                'animal_type_id' => '0cfe2c0e-1b19-42ad-9531-14aaaf724e93',
                'menu_id' => 3,
            ],
            [
                'title' => 'Szilveszter óta keressük Micit',
                'description' => 'Szilveszter óta keressük Micit, de nem adjuk fel!\n
                Csatolok róla egy képet,többen látták de mi nem találtuk meg.\n
                Ezen a mobilszámon bármikor elérhető van, minden információ érdekel esetleges legrosszabb hír is. Köszönöm!\n\n
                Kovács Krisztina\n
                06309987521\n
                krisztuuka@citromail.hu',
                'image_ids' => json_encode(array(11, 12, 13)),
                'category_id' => 2,
                'user_id' => 3,
                'animal_type_id' => '811607b6-2a1a-42dd-8de5-32016c0464bf',
                'menu_id' => 5,
            ],
            [
                'title' => 'Elveszett szeretett kiskutyám!',
                'description' => 'Elveszett szeretett kiskutyám aug.27-én a délutáni órákban Szigetszentmiklósról, a Szőlő közből. Chip van benne (chipszám: 900032001610546), félénk, kis termetű, kan, fekete-fehér harlekin uszkár. Gucci névre hallgat.\n
                MAGAS PÉNZ JUTALOM A BECSÜLETES MEGTALÁLÓNAK VAGY NYOMRAVEZETŐNEK!\n\n
                Hohl Bernadett\n
                06203934625 vagy 06209622373\n
                detti2310@gmail.com',
                'image_ids' => json_encode(array(14, 15, 16)),
                'category_id' => 2,
                'user_id' => 4,
                'animal_type_id' => 'd9c462a8-f10d-4d6c-9ceb-41022444155a',
                'menu_id' => 5,
            ],
            [
                'title' => 'Elveszett szeretett kiskutyám!',
                'description' => 'Elveszett szeretett kiskutyám aug.27-én a délutáni órákban Szigetszentmiklósról, a Szőlő közből. Chip van benne (chipszám: 900032001610546), félénk, kis termetű, kan, fekete-fehér harlekin uszkár. Gucci névre hallgat.\n
                MAGAS PÉNZ JUTALOM A BECSÜLETES MEGTALÁLÓNAK VAGY NYOMRAVEZETŐNEK!\n\n
                Hohl Bernadett\n
                06203934625 vagy 06209622373\n
                detti2310@gmail.com',
                'image_ids' => json_encode(array(17)),
                'category_id' => 3,
                'user_id' => 4,
                'animal_type_id' => '811607b6-2a1a-42dd-8de5-32016c0464bf',
                'menu_id' => 7,
            ],
        ];

        foreach ($animals as $animal) {
            Animal::create(array(
                'title' => $animal['title'],
                'description' => $animal['description'],
                'image_ids' => $animal['image_ids'],
                'category_id' => $animal['category_id'],
                'user_id' => $animal['user_id'],
                'animal_type_id' => $animal['animal_type_id'],
                'menu_id' => $animal['menu_id'],
            ));
        }
    }
}
