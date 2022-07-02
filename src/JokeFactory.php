<?php

namespace Zoneconnect\JustJokes;

use GuzzleHttp\Client;
use Zoneconnect\JustJokes\Models\JokeApi;

class JokeFactory
{
    public static function create(Client $client = null)
    {
        return new JokeApi($client);
    }
}
