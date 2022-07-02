<?php

use Illuminate\Support\Facades\Route;
use Zoneconnect\JustJokes\Http\Controllers\ChuckJokesController;

Route::get(config(\Zoneconnect\JustJokes\JokesServiceProvider::CONFIG_KEY.'.route'), ChuckJokesController::class);
