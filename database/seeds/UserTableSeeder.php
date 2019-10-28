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

        $employee = new User();
        $employee->name = 'Admin Name';
        $employee->email = 'soy@admin.com';
        $employee->password = bcrypt('123456');
        $employee->save();
        $employee->roles()->attach($role_admin);

        $manager = new User();
        $manager->name = 'User Name';
        $manager->email = 'soy@user.com';
        $manager->password = bcrypt('123456');
        $manager->save();
        $manager->roles()->attach($role_user);
    }
}
