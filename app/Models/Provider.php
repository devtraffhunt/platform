<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';

    public $timestamps = false; // поля называются created / updated

    protected $fillable = [
        'config_name',
        'name',
        'logo',
        'icon',
        'created',
        'updated',
    ];

    protected $casts = [
        'created' => 'datetime',
        'updated' => 'datetime',
    ];
}
