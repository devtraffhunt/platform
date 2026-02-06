<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    public $timestamps = false; // поля называются created / updated

    protected $fillable = [
        'game_key',
        'title',
        'alias',
        'provider',
        'provider_id',
        'is_show',
        'is_demo'.
        'priority',
        'banner_img',
        'aggregator',
        'created',
        'updated',
    ];

    protected $casts = [
        'is_show' => 'boolean',
        'is_demo' => 'boolean',
        'priority' => 'integer',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

    public function providerRelation()
    {
        return $this->belongsTo(Provider::class, 'provider', 'config_name');
    }
}
