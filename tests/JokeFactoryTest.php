<?php

namespace Zoneconnect\JustJokes\Tests;

use PHPUnit\Framework\TestCase;
use Zoneconnect\JustJokes\JokeFactory;
use Zoneconnect\JustJokes\Models\Joke;

class JokeFactoryTest extends TestCase
{
    /** @test */
    public function it_creates_a_valid_joke_instance()
    {
        $jokeInstance = JokeFactory::create();

        $this->assertInstanceOf(\Zoneconnect\JustJokes\Models\Joke::class, $jokeInstance);
    }

    /** @test */
    public function it_creates_a_valid_joke_instance_with_given_variables_and_returns_a_random_joke()
    {
        $chuckNorrisJokes = [
            'Chuck Norris doesn’t read books. He stares them down until he gets the information he wants.',
            'Time waits for no man. Unless that man is Chuck Norris.',
            'The dinosaurs looked at Chuck Norris the wrong way once. You know what happened to them.',
        ];

        /** @var Joke $jokeInstance */
        $jokeInstance = JokeFactory::create($chuckNorrisJokes);

        $randomJoke = $jokeInstance->getRandomJoke();

        // $this->assertEquals($testJoke, $randomJoke);
        $this->assertContains($randomJoke, $chuckNorrisJokes);
    }
}
