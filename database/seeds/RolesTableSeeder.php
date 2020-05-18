<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create(['name' => 'manager']);
        Role::create(['name' => 'user']);
    }
}
