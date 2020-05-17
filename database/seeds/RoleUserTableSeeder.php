<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
class RoleUserTableSeeder extends Seeder
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

        DB::table('role_user')->insert([
            'role_id' => '1',
            'user_id' => '1'
        ]);

       
        
    }
}
