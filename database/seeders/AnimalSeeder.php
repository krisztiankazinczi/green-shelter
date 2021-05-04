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
        $animal_type6 = AnimalType::where('name', 'Tacskó')->first();


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
                'title' => 'Pénteken (07.22.) délután eltűnt Mogyoródon a kutyusunk Szuszi',
                'description' => 'Pénteken (07.22.) délután eltűnt Mogyoródon a kutyusunk Szuszi. 3 hónapos fekete törpe tacskó kislány.
                Nagyon hiányzik a gyerekeknek és nekünk is!                
                Gálfi Ildikó
                06 30 730 1356
                anyuci400@gmail.com',
                'user_id' => 3,
                'animal_type_id' => $animal_type5->id,
                'menu_id' => 7,
            ],
            [
                'title' => '08.12-én elszökött Szotyi!',
                'description' => '08.12-én elszökött Szotyi névre hallgató kis drótszőrű tacskónk Fótról, 
                a Vörösmarty Mihály utcából. 4 hónapos, chipet még nem kapott. Piros AniOne nyakörve van, ismertetőjegye, hogy a szája alsó része és az orra hegye rózsaszín.
                Mechura Balázs
                balazs.mechura@yahoo.com',
                'user_id' => 4,
                'animal_type_id' => $animal_type6->id,
                'menu_id' => 7,
            ],
            [
                'title' => 'Pehely',
                'description' => 'Pehely
                2019.10.szül.keverék kan
                2021.04.26. Csörög
                Èrdeklődni lehet munkaidőben a 0620/424-5367-es telefonszàmon vagy szemèlyesen előre egyeztetett időpontban a Külső Ràdi ùti telepünkön
                FOGLALT!',
                'user_id' => 5,
                'animal_type_id' => $animal_type1->id,
                'menu_id' => 9,
            ],
            [
                'title' => 'Gizike',
                'description' => '2012.01. szül. keverék szuka
                2021.04.27. Gödi kobzás
                Marmagasság:38cm
                Èrdeklődni lehet munkaidőben a 0620/424-5367-es telefonszàmon vagy szemèlyesen előre egyeztetett időpontban a Külső Ràdi ùti telepünkön',
                'user_id' => 5,
                'animal_type_id' => $animal_type1->id,
                'menu_id' => 3,
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
