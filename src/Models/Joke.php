<?php

namespace Zoneconnect\JustJokes\Models;

class Joke
{
    public function __construct(
        protected array $jokes = []
    ) {
    }

    public function getRandomJoke()
    {
        if (empty($this->jokes)) {

      // fetch list from API/DB
        }

        return $this->jokes[random_int(0, (count($this->jokes) - 1))];
    }
}
