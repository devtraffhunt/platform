<?php

namespace App\Enums;

enum GameTransactionType: string
{
    case BET    = 'bet';
    case WIN    = 'win';
    case REFUND = 'refund';
}
