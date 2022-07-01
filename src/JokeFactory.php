<?php

namespace Zoneconnect\JustJokes;

use GuzzleHttp\Client;
use Zoneconnect\JustJokes\Models\Joke;

class JokeFactory
{
    public static function create(Client $client = null)
    {
        return new Joke($client);
    }
}
