<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\DepositMethodActive;

class DepositMethod extends Model
{
    protected $table = 'deposits_methods';

    public $timestamps = false; // потому что поля называются "created" и "updated", а не created_at/updated_at

    protected $fillable = [
        'payments_systems_id',
        'name',
        'icon',
        'currency',
        'min_amount',
        'max_amount',
        'active',
        'ttl_minutes',
        'created',
        'updated',
    ];

    protected $casts = [
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
        'ttl_minutes' => 'integer',
        'created' => 'datetime',
        'updated' => 'datetime',
        'active' => DepositMethodActive::class,
    ];

    public function paymentSystem(): BelongsTo
    {
        return $this->belongsTo(PaymentSystem::class, 'payments_systems_id');
    }
}
