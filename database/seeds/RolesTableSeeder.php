<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        $roles = [
            ['name' => 'admin'],
            ['name' => 'user'],
        ];

        foreach ($roles as $role) {
            \App\Role::create($role);
        }
    }
}
