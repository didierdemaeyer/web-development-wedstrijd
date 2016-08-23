<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->delete();

        $admin_role = \App\Role::where('name', 'admin')
            ->first()
            ->id;

        $user_role = \App\Role::where('name', 'user')
            ->first()
            ->id;

        $users = [
            [
                'firstname' => 'Admin',
                'lastname' => '',
                'email' => 'admin@tnf.be',
                'password' => bcrypt('root'),
                'address' => 'Frans Cretenlaan 55',
                'postcode' => '2627',
                'city' => 'Schelle',
                'country' => 'België',
                'ip_address' => '0.0.0.0',
                'role_id' => $admin_role,
            ],
        ];

        foreach ($users as $user) {
            \App\User::create($user);
        }
    }
}
