<?php


namespace Zoneconnect\JustJokes\Console;


use Illuminate\Console\Command;
use Zoneconnect\JustJokes\Facade\Jokes as FacadeJokes;

class Jokes extends Command
{

  protected $signature = "zc:joke";


  protected $description = "Output a funny random Chuck Norris Joke!";


  public function handle()
  {
    $this->info(FacadeJokes::getRandomJoke());
  }
}
