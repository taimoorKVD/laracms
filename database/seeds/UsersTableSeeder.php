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
        $user = \App\User::where('email', 'parker@laracms.com')->first();
        if(!$user)
            \App\User::create([
                'name' => 'Peter Parker',
                'email' => 'parker@laracms.com',
                'password' => \Illuminate\Support\Facades\Hash::make('temp'),
                'role' => 'admin',
                'about' => 'Peter Parker is an administrator'
            ]);
    }
}
