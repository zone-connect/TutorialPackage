<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Zoneconnect\JustJokes\Models\Joke;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JokeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Joke::factory(3)        
        ->create();
    }
}
