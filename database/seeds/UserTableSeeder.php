<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'admin')->first();
        $role_user  = Role::where('name', 'user')->first();

        $user = new User();
        $user->name = 'Admin Name';
        $user->email = 'soy@admin.com';
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'User Name 1';
        $user->email = 'soy@user.com';
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'User Name 2';
        $user->email = 'soy@user2.com';
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'User Name 3';
        $user->email = 'soy@user3.com';
        $user->password = bcrypt('123456');
        $user->save();
        $user->roles()->attach($role_user);
    }
}
