<?php

use App\Models\Text;
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
        Text::truncate();

        Text::create([
            'keyword' => 'example',
            'text' => 'lorem ipsum',
        ]);
        /*User::truncate();

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
        ]);*/    
    }
}
