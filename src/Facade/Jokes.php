<?php

namespace Zoneconnect\JustJokes\Facade;

use Illuminate\Support\Facades\Facade;

class Jokes extends Facade
{
  
  const ACCESSOR = "just-jokes";


  protected static function getFacadeAccessor()
  {
    return self::ACCESSOR;
  }
}
