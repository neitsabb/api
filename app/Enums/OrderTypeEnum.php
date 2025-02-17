<?php

namespace App\Enums;

enum OrderTypeEnum: string
{
    case DINE_IN = 'dine-in';
    case TAKE_AWAY = 'take-away';
}
