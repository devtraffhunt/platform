<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\GameTransactionType;

class GameTransaction extends Model
{
    protected $table = 'games_transactions';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'game_id',
        'external_id',
        'provider_id',
        'transaction_type',
        'amount',
        'balance_before',
        'balance_after',
        'currency',
        'payload',
        'created',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'balance_before' => 'decimal:2',
        'balance_after' => 'decimal:2',
        'currency' => 'string',
        'payload' => 'array',
        'created' => 'datetime',
        'transaction_type' => GameTransactionType::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}
