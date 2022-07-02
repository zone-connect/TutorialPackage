<?php

namespace Zoneconnect\JustJokes\Http\Controllers;

use Zoneconnect\JustJokes\Facade\Jokes;

class ChuckJokesController
{
    public function __invoke()
    {
        return view('just-jokes::joke', ['joke' => Jokes::getRandomJoke()]);
    }
}
