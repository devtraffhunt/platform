<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanType extends Model
{
     protected $table = 'bans_types';
     protected $fillable = ['name', 'rules_json'];
}
