<?php

namespace App\Enums;

enum CashflowType: string
{
    case INCOME     = 'income';
    case PAYOUT     = 'payout';
    case REFUND     = 'refund';
    case ADJUSTMENT = 'adjustment';
}
