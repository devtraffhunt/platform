<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSystemWithdraw extends Model
{
    protected $table = 'ps_withdraws';

    protected $fillable = [
        'payments_systems_id',
        'amount',
        'amount_usd',
        'amount_without_fee',
        'transaction_link',
        'receipted',
        'details',
        'created',
        'updated',
    ];

    public $timestamps = false;

    protected $casts = [
        'amount' => 'decimal:2',
        'amount_usd' => 'decimal:2',
        'amount_without_fee' => 'decimal:2',
        'receipted' => 'datetime',
        'created' => 'datetime',
        'updated' => 'datetime',
    ];

    public function paymentSystem()
    {
        return $this->belongsTo(PaymentSystem::class, 'payments_systems_id');
    }
}
