<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WithdrawFrozen extends Model
{
     protected $table = 'withdraws_frozen';
     protected $fillable = ['user_id', 'details', 'amount', 'system_id', 'system_img', 'status', 'created_at', 'updated_at'];
}
