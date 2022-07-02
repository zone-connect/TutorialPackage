<?php

namespace Zoneconnect\JustJokes;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Zoneconnect\JustJokes\Console\Jokes as JokesCommand;
use Zoneconnect\JustJokes\Http\Controllers\ChuckJokesController;

class JokesServiceProvider extends ServiceProvider
{

  public function register()
  {
    // binding our facade accessor. Let Laravel know how to resolve it from container.
    $this->app->bind(\Zoneconnect\JustJokes\Facade\Jokes::ACCESSOR, function () {
      return JokeFactory::create(new Client());
    });
  }


  public function boot()
  {
    if ($this->app->runningInConsole()) {
      $this->commands([
        JokesCommand::class
      ]);
    }

    // Load views
    $this->loadViewsFrom(__DIR__ . "/../resources/views", "just-jokes");

    // Add package routes
    Route::get('chuck-jokes', ChuckJokesController::class);
  }
}
