<?php

namespace Zoneconnect\JustJokes\Models;

use GuzzleHttp\Client;

class JokeApi
{
    // move to config
    const API_ENDPOINT = 'https://api.chucknorris.io/jokes/random';

    public function __construct(
        protected Client $client
    ) {
    }

    /**
     * @TODO Refactor/error handling
     *
     * @return string
     */
    public function getRandomJoke(): string
    {
        if (is_null($this->client)) {
            return 'No Joke';
        }

        $data = $this->client->get(self::API_ENDPOINT);

        $jokes = json_decode($data->getBody()->getContents());

        return $jokes->value;
    }
}
