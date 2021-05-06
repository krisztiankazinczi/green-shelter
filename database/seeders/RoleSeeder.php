<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'name' => 'Guest' ],
            [ 'name' => 'Registered' ],
            [ 'name' => 'Admin' ],
        ];

        foreach ($roles as $role) {
            Role::create(array(
                'name' => $role['name']
            ));
        }
    }
}
