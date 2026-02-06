<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'alpha2Code',
        'alpha3Code',
        'region',
        'native_name',
        'flag',
        'currency',
        'calling_code',
    ];

    // Если нужно привести валюту к верхнему регистру, можно использовать accessor:
    public function getCurrencyAttribute($value)
    {
        return strtoupper($value);
    }
}
