<?php

namespace Zoneconnect\JustJokes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Joke extends Model
{

  use HasFactory;

  /** @var array */
  protected $guarded = [];


  /** @var string */
  protected $table = "zc_jokes";
}
