<?php

namespace Zoneconnect\JustJokes;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Zoneconnect\JustJokes\Console\Jokes as JokesCommand;


class JokesServiceProvider extends ServiceProvider
{

  /**
   * From what I can tell - This Key MUST match the config filename
   * O/w the published config file won't have any effect. Strange
   * 
   */
  const CONFIG_KEY = "just-jokes";


  public function register()
  {
    // binding our facade accessor. Let Laravel know how to resolve it from container.
    $this->app->bind(\Zoneconnect\JustJokes\Facade\Jokes::ACCESSOR, function () {
      return JokeFactory::create(new Client());
    });


    /**
     * Publish our config file settings. The key 'jokes' - is how we will access the members of this
     * config file e.g [jokes.route]
     */
    $this->mergeConfigFrom(__DIR__ . "/../config/just-jokes.php", self::CONFIG_KEY);
  }


  public function boot()
  {
    if ($this->app->runningInConsole()) {

      $this->commands([
        JokesCommand::class
      ]);

      // To allow developers to customize resources, we need to publish them.. here is how
      // publish this rosource to => specified destination
      $this->publishes([
        __DIR__ . '/../resources/views' => resource_path('views/vendor/just-jokes'),
      ], "jokes-views");

      // publish config file
      $this->publishes([
        __DIR__ . '/../config/just-jokes.php' => config_path('just-jokes.php'),
      ], "jokes-config");
    }

    $this->registerRoutes();

    // Load views :; this will tell laravel to use views directly from the package
    $this->loadViewsFrom(__DIR__ . "/../resources/views", "just-jokes");
  }


  /**
   * Register the package routes.
   *
   * @return void
   */
  private function registerRoutes()
  {
    Route::group($this->routeConfiguration(), function () {
      $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
    });
  }


  /**
   * Route group configuration array.
   *
   * @return array
   */
  private function routeConfiguration()
  {
    return [
      // 'domain' => config('telescope.domain', null),
      // 'namespace' => 'Laravel\Telescope\Http\Controllers',
      'prefix' => config(self::CONFIG_KEY . '.prefix'),
      'middleware' => 'guest',
    ];
  }
}
