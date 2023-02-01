<?php

namespace App\Enums;

enum JobEnum: string
{
    case Manager = 'manager';
    case Programmer = 'programmer';
    case HR = 'hr';
    case Support = 'support';
}
