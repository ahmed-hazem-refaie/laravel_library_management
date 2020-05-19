<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        $manager = User::create([
            'name' =>'Manager user',
            'email' => 'manager@manager.com',
            'password' =>Hash::make('password')
        ]);
        
        $user = User::create([
            'name' =>'Generic User',
            'email' => 'user@user.com',
            'password' =>Hash::make('password')
        ]);
    }
}
