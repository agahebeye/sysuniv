<?php

namespace App\Enums;

enum ResultStatus: string
{
    case PENDING = 'En suspens';
    case PASSED = 'Réussi';
    case CREDITED = 'Réussi avec complément(s)';
    case FAILED = 'Echoué';
    case ABANDONED = 'Abandonné';
}
