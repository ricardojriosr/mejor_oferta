<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = new Role();
        $role_employee->name = 'admin';
        $role_employee->description = 'An Admin User';
        $role_employee->save();

        $role_manager = new Role();
        $role_manager->name = 'user';
        $role_manager->description = 'A regular User';
        $role_manager->save();
    }
}
