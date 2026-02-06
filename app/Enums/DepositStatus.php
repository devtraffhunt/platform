<?php

namespace App\Enums;

enum DepositStatus: string
{
    case PROCESSING = 'processing';
    case SUCCESS    = 'success';
    case FAILED     = 'failed';
    case PAID_OUT   = 'paid_out';
}
