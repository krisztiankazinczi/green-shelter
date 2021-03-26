<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Test User',
                'email' => 'test@test.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Monika',
                'email' => 'monika@test.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Orsi',
                'email' => 'orsi@test.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Dani',
                'email' => 'dani@test.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => Hash::make('12345678'),
                'role_id' => 3
            ],
        ];

        foreach ($users as $user) {
            if (array_key_exists("role_id",$user)) {
                User::create(array(
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'role_id' => $user['role_id']
                ));
            } else {
                User::create(array(
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                ));
            }
        }
    }
}
