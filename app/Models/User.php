<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use App\Enums\UserType;
use App\Enums\RegistrationType;
use App\Enums\OcType;
use App\Enums\DeviceType;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    protected $table = 'users';

    protected $fillable = [
        'type',
        'first_user_id',
        'external_id',
        'affiliate_id',
        'phone',
        'phone_verified_date',
        'email',
        'email_verified_date',
        'google_id',
        'google_connect_date',
        'telegram_id',
        'telegram_connect_date',
        'avatar',
        'password',
        'first_name',
        'last_name',
        'registration_ip',
        'registration_country_id',
        'registration_user_agent',
        'registration_oc',
        'registration_device_type',
        'type_registration',
        'registration_bonus_id',
        'registration_game_id',
        'registration_url',
        'registration_domain_id',
        'is_frozen',
        'frozen_id',
        'frozen_date',
        'is_ban',
        'ban_id',
        'ban_date',
        'balance_real',
        'balance_demo',
        'withdraws_amount',
        'withdraws_count',
        'deposits_amount',
        'deposits_count',
        'win_amount',
        'lose_amount',
        'bonus_amount',
        'games_count_used',
        'favorite_game_id',
        'favorite_category_id',
        'favorite_provider_id',
        'maximum_win_amount',
        'bets_amount',
        'bets_counts',
        'last_bet_date',
        'payout_amount_affiliate',
        'first_deposit_amount',
        'first_deposit_date',
        'last_deposit_amount',
        'last_deposit_date',
        'last_withdraw_amount',
        'last_withdraw_date',
        'is_cpa',
        'is_rs',
        'last_visit_date',
        'last_login_id',
        'currency',
        'sub1',
        'sub2',
        'sub3',
        'sub4',
        'sub5',
        'token',
        'remember_token',
        'created',
        'updated',
    ];

    public $timestamps = false;

    protected $casts = [
        // ENUM касты
        'type' => UserType::class,
        'registration_oc' => OcType::class,
        'registration_device_type' => DeviceType::class,
        'type_registration' => RegistrationType::class,

        // даты
        'phone_verified_date' => 'datetime',
        'email_verified_date' => 'datetime',
        'google_connect_date' => 'datetime',
        'telegram_connect_date' => 'datetime',
        'frozen_date' => 'datetime',
        'ban_date' => 'datetime',
        'last_bet_date' => 'datetime',
        'first_deposit_date' => 'datetime',
        'last_deposit_date' => 'datetime',
        'last_withdraw_date' => 'datetime',
        'last_visit_date' => 'datetime',
        'created' => 'datetime',
        'updated' => 'datetime',

        // флаги
        'is_frozen' => 'boolean',
        'is_ban' => 'boolean',
        'is_cpa' => 'boolean',
        'is_rs' => 'boolean',

        // суммы
        'balance_real' => 'decimal:2',
        'balance_demo' => 'decimal:2',
        'withdraws_amount' => 'decimal:2',
        'deposits_amount' => 'decimal:2',
        'win_amount' => 'decimal:2',
        'lose_amount' => 'decimal:2',
        'bonus_amount' => 'decimal:2',
        'maximum_win_amount' => 'decimal:2',
        'bets_amount' => 'decimal:2',
        'payout_amount_affiliate' => 'decimal:2',
        'first_deposit_amount' => 'decimal:2',
        'last_deposit_amount' => 'decimal:2',
        'last_withdraw_amount' => 'decimal:2',
    ];
}
