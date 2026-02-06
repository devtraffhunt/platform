<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSystem extends Model
{
    protected $table = 'payments_systems';

    public $timestamps = false; // потому что поля называются created / updated

    protected $fillable = [
        'name',
        'link',
        'color',
        'logo',
        'config',
        'percent',
        'created',
        'updated',
    ];

    protected $casts = [
        'percent' => 'decimal:2',
        'config' => 'array',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];
}
