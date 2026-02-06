<?php

namespace App\Enums;

enum OcType: string
{
    case WINDOWS = 'windows';
    case LINUX   = 'linux';
    case MACOS   = 'macos';
    case ANDROID = 'android';
    case IOS     = 'ios';
    case OTHER     = 'other';
}
