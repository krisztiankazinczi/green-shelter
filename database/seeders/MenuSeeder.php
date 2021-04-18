<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuOptions = [
            [
                'route' => 'home',
                'name' => 'Kezdőlap',
                'role_id' => '1',
            ],
            [
                'route' => 'animals',
                'name' => 'Gazdira váró állatok',
                'role_id' => '1',
            ],
            [
                'route' => 'dogs',
                'name' => 'Gazdira váró kutyák',
                'parent' => 2,
                'role_id' => '1',
            ],
            [
                'route' => 'dogs/create',
                'name' => 'Gazdira váró kutyák regisztrálása',
                'parent' => 2,
                'role_id' => '3',
            ],
            [
                'route' => 'cats',
                'name' => 'Gazdira váró macskák',
                'parent' => 2,
                'role_id' => '1',
            ],
            [
                'route' => 'cats/create',
                'name' => 'Gazdira váró macskák regisztrálása',
                'parent' => 2,
                'role_id' => '3',
            ],
            [
                'route' => 'lost-dogs',
                'name' => 'Elveszett kutyák',
                'parent' => 2,
                'role_id' => '1',
            ],
            [
                'route' => 'lost-dogs/create',
                'name' => 'Elveszett kutyák regisztrálása',
                'parent' => 2,
                'role_id' => '2',
            ],
            [
                'route' => 'found-dogs',
                'name' => 'Talált kutyák',
                'parent' => 2,
                'role_id' => '1',
            ],
            [
                'route' => 'found-dogs/create',
                'name' => 'Talált kutyák Regisztrálása',
                'parent' => 2,
                'role_id' => '2',
            ],
            [
                'route' => 'advertisements',
                'name' => 'Lakossági hirdetések',
                'parent' => 2,
                'role_id' => '1',
            ],
            [
                'route' => 'advertisements/create',
                'name' => 'Lakossági hirdetések létrehozása',
                'parent' => 2,
                'role_id' => '2',
            ],
            [
                'route' => 'animal-of-week',
                'name' => 'A hét állata',
                'role_id' => '1',
            ],
            [
                'route' => 'success-stories',
                'name' => 'Sikertörténetek',
                'role_id' => '1',
            ],
            [
                'route' => 'gallery',
                'name' => 'Képgaléria',
                'role_id' => '1',
            ],
            [
                'route' => 'stories',
                'name' => 'Írásaink',
                'role_id' => '1',
            ],
            [
                'route' => 'about-us',
                'name' => 'Rólunk',
                'role_id' => '1',
            ],
            [
                'route' => '',
                'name' => 'Rólunk',
                'parent' => 17,
                'role_id' => '1',
            ],
            [
                'route' => 'contact-details',
                'name' => 'Kapcsolat',
                'parent' => 17,
                'role_id' => '1',
            ],
            [
                'route' => 'reviews',
                'name' => 'Rólunk mondták',
                'parent' => 17,
                'role_id' => '1',
            ],
            [
                'route' => 'write-review',
                'name' => 'Véleményezés',
                'parent' => 17,
                'role_id' => '2',
            ],
            [
                'route' => 'admin-dashboard',
                'name' => 'Admin Felület',
                'role_id' => '3',
            ],
        ];
        
        foreach ($menuOptions as $option) {
            if (array_key_exists("parent",$option)) {
                Menu::create(array(
                    'route' => $option['route'],
                    'name' => $option['name'],
                    'parent' => $option['parent'],
                    'role_id' => $option['role_id']
                ));
            } else {
                Menu::create(array(
                    'route' => $option['route'],
                    'name' => $option['name'],
                    'role_id' => $option['role_id']
                ));
            }
        }

    }
}
