<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Providers extends Model
{
    protected $table = 'providers';
    protected $guarded = [];
}
