<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role1 = DB::table('roles')->where('name', '=', 'Guest')->select('id')->first();
        $role2 = DB::table('roles')->where('name', '=', 'Registered')->select('id')->first();
        $role3 = DB::table('roles')->where('name', '=', 'Admin')->select('id')->first();

        $menuOptions = [
            [
                'route' => 'home',
                'name' => 'Kezdőlap',
                'role_id' => $role1->id,
            ],
            [
                'route' => 'animals',
                'name' => 'Gazdira váró állatok',
                'role_id' => $role1->id,
            ],
            [
                'route' => 'dogs',
                'name' => 'Gazdira váró kutyák',
                'parent' => 2,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'dogs/create',
                'name' => 'Gazdira váró kutyák regisztrálása',
                'parent' => 2,
                'role_id' => $role3->id,
            ],
            [
                'route' => 'cats',
                'name' => 'Gazdira váró macskák',
                'parent' => 2,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'cats/create',
                'name' => 'Gazdira váró macskák regisztrálása',
                'parent' => 2,
                'role_id' => $role3->id,
            ],
            [
                'route' => 'lost-dogs',
                'name' => 'Elveszett kutyák',
                'parent' => 2,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'lost-dogs/create',
                'name' => 'Elveszett kutyák regisztrálása',
                'parent' => 2,
                'role_id' => $role2->id,
            ],
            [
                'route' => 'found-dogs',
                'name' => 'Talált kutyák',
                'parent' => 2,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'found-dogs/create',
                'name' => 'Talált kutyák Regisztrálása',
                'parent' => 2,
                'role_id' => $role2->id,
            ],
            [
                'route' => 'advertisements',
                'name' => 'Lakossági hirdetések',
                'parent' => 2,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'advertisements/create',
                'name' => 'Lakossági hirdetések létrehozása',
                'parent' => 2,
                'role_id' => $role2->id,
            ],
            [
                'route' => 'animal-of-week',
                'name' => 'A hét állata',
                'role_id' => $role1->id,
            ],
            [
                'route' => 'success-stories',
                'name' => 'Sikertörténetek',
                'role_id' => $role1->id,
            ],
            [
                'route' => 'gallery',
                'name' => 'Képgaléria',
                'role_id' => $role1->id,
            ],
            [
                'route' => 'stories',
                'name' => 'Írásaink',
                'role_id' => $role1->id,
            ],
            [
                'route' => 'about-us',
                'name' => 'Rólunk',
                'role_id' => $role1->id,
            ],
            [
                'route' => '',
                'name' => 'Rólunk',
                'parent' => 17,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'contact-details',
                'name' => 'Kapcsolat',
                'parent' => 17,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'reviews',
                'name' => 'Rólunk mondták',
                'parent' => 17,
                'role_id' => $role1->id,
            ],
            [
                'route' => 'admin-dashboard/adoption/requested/all/7',
                'name' => 'Admin Felület',
                'role_id' => $role3->id,
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
