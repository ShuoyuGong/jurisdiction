<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Manager extends Model
{
  //
  use EntrustUserTrait;
}
