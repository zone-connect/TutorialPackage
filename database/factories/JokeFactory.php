<?php

namespace Database\Factories\Zoneconnect\JustJokes\Models;

use Zoneconnect\JustJokes\Models\Joke;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Zoneconnect\JustJokes\Models\Joke>
 */
class JokeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Joke::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'joke' => $this->faker->text()
        ];
    }
}
