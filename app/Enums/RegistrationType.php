<?php

namespace App\Enums;

enum RegistrationType: string
{
    case TELEGRAM = 'telegram';
    case QUICK    = 'quick';
    case GOOGLE   = 'google';
}
