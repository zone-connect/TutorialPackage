<?php

namespace Zoneconnect\JustJokes\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Zoneconnect\JustJokes\JokeFactory;
use Zoneconnect\JustJokes\Models\Joke;

class JokeFactoryTest extends TestCase
{
    const JOKE_TEXT = "Following every bowl of horse hair & ballbearing bisque, Chuck Norris drinks a quart of Liquid Plummer to aid in digestion.";

    const SAMPLE_JOKE = '{
        "categories":[],
        "created_at":"2020-01-05 13:42:29.296379",
        "icon_url":"https://assets.chucknorris.host/img/avatar/chuck-norris.png",
        "id":"dTVvGANxS_y99xg3PCTqfQ",
        "updated_at":"2020-01-05 13:42:29.296379",
        "url":"https://api.chucknorris.io/jokes/dTVvGANxS_y99xg3PCTqfQ",
        "value":"Following every bowl of horse hair & ballbearing bisque, Chuck Norris drinks a quart of Liquid Plummer to aid in digestion."
    }';


    private $client = null;


    public function setUp(): void
    {
        parent::setUp();
        
        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(
                200,
                [],
                self::SAMPLE_JOKE
            ),
            // new Response(202, ['Content-Length' => 0]),
            // new RequestException('Error Communicating with Server', new Request('GET', 'test'))
        ]);

        $handlerStack = HandlerStack::create($mock);
        $this->client = new Client(['handler' => $handlerStack]);
    }


    /** @test */
    public function it_creates_a_valid_joke_instance()
    {
        $jokeInstance = JokeFactory::create($this->client);

        $this->assertInstanceOf(\Zoneconnect\JustJokes\Models\JokeApi::class, $jokeInstance);
    }


    /** @test */
    public function it_creates_a_valid_joke_instance_with_given_variables_and_returns_a_random_joke()
    {
        /** @var Joke $jokeInstance */
        $jokeInstance = JokeFactory::create($this->client);

        $randomJoke = $jokeInstance->getRandomJoke();

        $this->assertEquals(self::JOKE_TEXT, $randomJoke);
        // $this->assertContains($randomJoke, $chuckNorrisJokes);
    }
}
