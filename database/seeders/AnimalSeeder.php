<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animal;
use App\Models\AnimalType;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $animal_type1 = AnimalType::where('name', 'Korcs')->first();
        $animal_type2 = AnimalType::where('name', 'Rottweiler')->first();
        $animal_type3 = AnimalType::where('name', 'Csivava')->first();
        $animal_type4 = AnimalType::where('name', 'Husky')->first();
        $animal_type5 = AnimalType::where('name', 'Golden Retriever')->first();

        $animals = [
            [
                'title' => 'Elveszett leonbergit keresi szerető családja!',
                'description' => 'Március 23-án eltűnt Ócsáról nagyon nagy méretű (kb. 75-80 cm marmagasságú lehet), leonbergi jellegű, chippelt, barna kan kutyusunk. Vélhetően tüzelő szukák után indult.
                Borisz névre hallgat, nagyon szerettük őt, a megtalálónak pénzjutalmat adnék.
                Csatoltam fotót róla, kérem, ha bármit tudnak, értesítsenek!
                Köszönettel:
                Dr. Gaál Ágnes
                06304339384',
                'user_id' => 1,
                'animal_type_id' => $animal_type1->id,
                'menu_id' => 3,
            ],
            [
                'title' => 'Buksit keresem!',
                'description' => 'Tavaly Máriakéméndről tűnt el. Azóta nem tudok sajnos róla semmit.
                Buksi névre hallgat. Chippel rendelkezik. Ivartalanított kan.3 éves lesz májusba
                elérhetőségem: 06705977263',
                'user_id' => 2,
                'animal_type_id' => $animal_type2->id,
                'menu_id' => 3,
                'animal_of_the_week' => true
            ],
            [
                'title' => 'Szilveszter óta keressük Micit',
                'description' => 'Szilveszter óta keressük Micit, de nem adjuk fel!
                Csatolok róla egy képet,többen látták de mi nem találtuk meg.
                Ezen a mobilszámon bármikor elérhető van, minden információ érdekel esetleges legrosszabb hír is. Köszönöm!
                Kovács Krisztina
                06309987521
                krisztuuka@citromail.hu',
                'user_id' => 3,
                'animal_type_id' => $animal_type3->id,
                'menu_id' => 3,
            ],
            [
                'title' => 'Elveszett szeretett kiskutyám!',
                'description' => 'Elveszett szeretett kiskutyám aug.27-én a délutáni órákban Szigetszentmiklósról, a Szőlő közből. Chip van benne (chipszám: 900032001610546), félénk, kis termetű, kan, fekete-fehér harlekin uszkár. Gucci névre hallgat.
                MAGAS PÉNZ JUTALOM A BECSÜLETES MEGTALÁLÓNAK VAGY NYOMRAVEZETŐNEK!
                Hohl Bernadett
                06203934625 vagy 06209622373
                detti2310@gmail.com',
                'user_id' => 2,
                'animal_type_id' => $animal_type4->id,
                'menu_id' => 3,
            ],
            [
                'title' => 'Szilveszter óta keressük Micit2',
                'description' => 'Szilveszter óta keressük Micit, de nem adjuk fel!
                Csatolok róla egy képet,többen látták de mi nem találtuk meg.
                Ezen a mobilszámon bármikor elérhető van, minden információ érdekel esetleges legrosszabb hír is. Köszönöm!
                Kovács Krisztina
                06309987521
                krisztuuka@citromail.hu',
                'user_id' => 3,
                'animal_type_id' => $animal_type5->id,
                'menu_id' => 7,
            ],
            [
                'title' => 'Elveszett szeretett kiskutyám3!',
                'description' => 'Elveszett szeretett kiskutyám aug.27-én a délutáni órákban Szigetszentmiklósról, a Szőlő közből. Chip van benne (chipszám: 900032001610546), félénk, kis termetű, kan, fekete-fehér harlekin uszkár. Gucci névre hallgat.
                MAGAS PÉNZ JUTALOM A BECSÜLETES MEGTALÁLÓNAK VAGY NYOMRAVEZETŐNEK!
                Hohl Bernadett
                06203934625 vagy 06209622373
                detti2310@gmail.com',
                'user_id' => 4,
                'animal_type_id' => $animal_type1->id,
                'menu_id' => 7,
            ],
            [
                'title' => 'Elveszett szeretett kiskutyám2!',
                'description' => 'Elveszett szeretett kiskutyám aug.27-én a délutáni órákban Szigetszentmiklósról, a Szőlő közből. Chip van benne (chipszám: 900032001610546), félénk, kis termetű, kan, fekete-fehér harlekin uszkár. Gucci névre hallgat.
                MAGAS PÉNZ JUTALOM A BECSÜLETES MEGTALÁLÓNAK VAGY NYOMRAVEZETŐNEK!
                Hohl Bernadett
                06203934625 vagy 06209622373
                detti2310@gmail.com',
                'user_id' => 4,
                'animal_type_id' => $animal_type2->id,
                'menu_id' => 9,
            ],
        ];

        foreach ($animals as $animal) {
            if (array_key_exists("animal_of_the_week", $animal)) {
                Animal::create(array(
                    'title' => $animal['title'],
                    'description' => $animal['description'],
                    'user_id' => $animal['user_id'],
                    'animal_type_id' => $animal['animal_type_id'],
                    'menu_id' => $animal['menu_id'],
                    'animal_of_the_week' => $animal['animal_of_the_week']
                ));
            } else {
                Animal::create(array(
                    'title' => $animal['title'],
                    'description' => $animal['description'],
                    'user_id' => $animal['user_id'],
                    'animal_type_id' => $animal['animal_type_id'],
                    'menu_id' => $animal['menu_id'],
                ));
            }
        }
    }
}
