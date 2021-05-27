<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role3 = DB::table('roles')->where('name', '=', 'Admin')->select('id')->first();

        $users = [
            [
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => Hash::make('12345678'),
                'avatar_uri' => 'users/user3.jpeg'
            ],
            [
                'name' => 'Monika',
                'email' => 'monika@test.com',
                'password' => Hash::make('12345678'),
                'avatar_uri' => 'users/user2.jpg'
            ],
            [
                'name' => 'Orsi',
                'email' => 'orsi@test.com',
                'password' => Hash::make('12345678'),
                'avatar_uri' => 'users/user1.jpg'
            ],
            [
                'name' => 'Dani',
                'email' => 'dani@test.com',
                'password' => Hash::make('12345678'),
                'avatar_uri' => 'users/user5.jpeg'
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('12345678'),
                'avatar_uri' => 'users/user4.jpeg',
                'role_id' => role3->id
            ],
        ];

        foreach ($users as $user) {
            if (array_key_exists("role_id",$user)) {
                User::create(array(
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'avatar_uri' => $user['avatar_uri'],
                    'role_id' => $user['role_id']
                ));
            } else {
                User::create(array(
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'avatar_uri' => $user['avatar_uri'],
                ));
            }
        }
    }
}
