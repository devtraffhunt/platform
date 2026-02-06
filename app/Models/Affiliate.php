<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $table = 'affiliates';

    protected $fillable = [
        'name',
        'postback_registration',
        'postback_deposit',
        'postback_rs',
        'postback_cpa',
        'type',
        'cpa_amount',
        'rs_percent',
    ];

    protected $casts = [
        'cpa_amount' => 'decimal:2',
        'rs_percent' => 'decimal:2',
        'type' => 'string', // ENUM('rs', 'cpa')
    ];

    // Пример: отношение к User (если есть user.affiliate_id)
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
