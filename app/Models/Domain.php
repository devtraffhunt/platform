<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'domains';

    protected $fillable = [
        'domain',
        'is_active',
        'affiliate_id',
        'created',
        'updated',
    ];

    public $timestamps = false;

    protected $casts = [
        'is_active' => 'boolean',
        'affiliate_id' => 'integer',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];
}
