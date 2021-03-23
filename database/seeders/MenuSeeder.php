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
                'route' => 'animals/dogs',
                'name' => 'Gazdira váró kutyák',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '1',
            ],
            [
                'route' => 'animals/cats',
                'name' => 'Gazdira váró macskák',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '1',
            ],
            [
                'route' => 'animals/lost-dogs',
                'name' => 'Elveszett kutyák',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '1',
            ],
            [
                'route' => 'animals/register-lost-dogs',
                'name' => 'Elveszett kutyák Regisztrálása',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '2',
            ],
            [
                'route' => 'animals/found-dogs',
                'name' => 'Talált kutyák',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '1',
            ],
            [
                'route' => 'animals/register-found-dogs',
                'name' => 'Talált kutyák Regisztrálása',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '2',
            ],
            [
                'route' => 'animals/advertisements',
                'name' => 'Lakossági hirdetések',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '1',
            ],
            [
                'route' => 'animals/register-advertisements',
                'name' => 'Lakossági hirdetések létrehozása',
                'parent' => 'Gazdira váró állatok',
                'role_id' => '2',
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
                'route' => 'contact-details',
                'name' => 'Elérhetőségeink',
                'role_id' => '1',
            ],
            [
                'route' => 'contact-details/about-us',
                'name' => 'Rólunk',
                'parent' => 'Elérhetőségeink',
                'role_id' => '1',
            ],
            [
                'route' => 'contact-details',
                'name' => 'Kapcsolat',
                'parent' => 'Elérhetőségeink',
                'role_id' => '1',
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
