<?php

namespace Zoneconnect\JustJokes;

use Zoneconnect\JustJokes\Models\Joke;

class JokeFactory
{
  public static function create(array $jokes = [])
  {
    return new Joke($jokes);
  }
}
