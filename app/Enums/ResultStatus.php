<?php

namespace App\Enums;

enum ResultStatus: string
{
    case PENDING = 'En suspens';
    case PASSED = 'Passé';
    case CREDITED = 'Passé avec complément(s)';
    case FAILED = 'Echoué';
    case ABANDONED = 'Abandonné';
}
