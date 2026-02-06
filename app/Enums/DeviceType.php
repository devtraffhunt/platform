<?php

namespace App\Enums;

enum DeviceType: string
{
    case MOBILE  = 'mobile';
    case TABLET  = 'table';   // хотя правильнее было бы `tablet`, но оставляем как в БД
    case DESKTOP = 'desktop';
    case OTHER = 'other';
}
