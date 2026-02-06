<?php

namespace App\Models;

use App\Enums\DepositStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    protected $table = 'deposits';

    public $timestamps = false; // используется created / updated вместо created_at / updated_at

    protected $fillable = [
        'user_id',
        'transaction_uuid',
        'external_id',
        'external_hash',
        'status',
        'amount',
        'currency',
        'details',
        'payments_systems_id',
        'deposits_methods_id',
        'bonus_percent',
        'payment_before_date',
        'balance_before',
        'balance_after',
        'callback',
        'created',
        'updated',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'bonus_percent' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'payment_before_date' => 'datetime',
        'created' => 'datetime',
        'updated' => 'datetime',
        'details' => 'array',
        'callback' => 'array',
        'status' => DepositStatus::class,
    ];

    // 🔗 Связи
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentSystem(): BelongsTo
    {
        return $this->belongsTo(PaymentSystem::class, 'payments_systems_id');
    }

    public function depositMethod(): BelongsTo
    {
        return $this->belongsTo(DepositMethod::class, 'deposits_methods_id');
    }
}
