<?php

namespace Zoneconnect\JustJokes\Tests;


use Illuminate\Support\Facades\Artisan;
use Zoneconnect\JustJokes\Facade\Jokes;
use Zoneconnect\JustJokes\JokesServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Zoneconnect\JustJokes\Facade\Jokes as JokesFacade;


/**
 * @see https://packages.tools/testbench/basic/testcase.html#package-service-providers
 * 
 */
class LaravelJokesCommandTest extends \Orchestra\Testbench\TestCase
{

  use RefreshDatabase;


  /**
   * Setup the test environment.
   */
  protected function setUp(): void
  {
    // Code before application created.

    parent::setUp();

    // Code after application created.
  }


  /**
   * To load your package service provider
   *
   * @param  \Illuminate\Foundation\Application  $app
   *
   * @return array
   */
  protected function getPackageProviders($app)
  {
    return [
      JokesServiceProvider::class
    ];
  }


  /**
   * Override application aliases.
   *
   * @param  \Illuminate\Foundation\Application  $app
   *
   * @return array
   */
  protected function getPackageAliases($app)
  {
    return [
      'Jokes' => JokesFacade::class,
    ];
  }


  /**
   * Define database migrations.
   *
   * @return void
   */
  protected function defineDatabaseMigrations()
  {
    $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
  }


  /** @test */
  public function it_returns_a_joke()
  {
    $expectedJoke = "Some random joke";

    // Disable console output mocking
    $this->withoutMockingConsoleOutput();

    // mock our command implementation
    Jokes::shouldReceive("getRandomJoke")
      ->once()
      ->andReturn($expectedJoke);

    // Run artisan command
    $this->artisan("zc:joke");

    // get the output of the above command
    $output = Artisan::output();

    // Need to add  . PHP_EOL b'se info() appends break line by default.
    $this->assertEquals($expectedJoke . PHP_EOL, $output);
  }


  /** @test */
  public function can_access_joke_route()
  {
    $prefix = config(\Zoneconnect\JustJokes\JokesServiceProvider::CONFIG_KEY . ".prefix");
    $urlKey = config(\Zoneconnect\JustJokes\JokesServiceProvider::CONFIG_KEY . ".route");

    $this->get($prefix . $urlKey)
      ->assertViewIs("just-jokes::joke")
      // Data key only. Can also add the value as second parameter is interested
      ->assertViewHas("joke")
      ->assertStatus(200);
  }


  /** @test */
  public function it_can_access_database()
  {
    // seed
    // \Zoneconnect\JustJokes\Models\Joke::factory(1)->create(); ?????

    // rude approach!
    $joke = new \Zoneconnect\JustJokes\Models\Joke();
    $joke->joke = "Watsaap";
    $joke->save();

    $this->assertDatabaseCount('zc_jokes', 1);

    $newRow = \Zoneconnect\JustJokes\Models\Joke::find($joke->id);
    $this->assertSame("Watsaap", $newRow->joke);
  }
}
