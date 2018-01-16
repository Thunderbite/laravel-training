<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Mark van der Putten',
            'email' => 'mark@thunderbite.com',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Vlad Filip',
            'email' => 'vlad@thunderbite.com',
            'password' => Hash::make('password')
        ]);
        User::create([
            'name' => 'Radu Tirnovan',
            'email' => 'radu@thunderbite.com',
            'password' => Hash::make('password')
        ]);    
    }
}
