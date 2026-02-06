<?php

namespace App\Enums;

enum UserType: string
{
    case USER       = 'user';
    case ADMIN      = 'admin';
    case INFLUENCER = 'influencer';
    case TEST       = 'test';
    case SUPPORT    = 'support';
    case MODERATOR    = 'moderator';
}

