<?php

namespace App\Enums;

enum DepositMethodActive: string
{
    case NONE = 'none';
    case ALL  = 'all';
    case FD   = 'fd';  // First Deposit
    case RD   = 'rd';  // Repeat Deposit
}
