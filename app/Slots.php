<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slots extends Model
{
    protected $table = 'slotsMOBULE';
    protected $guarded = [];

    // Связь с таблицей providers
    public function providerRelation()
    {
        return $this->hasOne(Providers::class, 'config_name', 'provider');
    }
}
