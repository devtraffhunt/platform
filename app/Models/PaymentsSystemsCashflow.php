<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\CashflowType;

class PaymentsSystemsCashflow extends Model
{
    protected $table = 'ps_cashflows';

    public $timestamps = false;

    protected $fillable = [
        'payments_systems_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'parent_id',
        'comment',
        'transaction_at',
        'created',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'transaction_at' => 'datetime',
        'created' => 'datetime',
        'type' => CashflowType::class,
    ];

    public function paymentSystem(): BelongsTo
    {
        return $this->belongsTo(PaymentSystem::class, 'payments_systems_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
