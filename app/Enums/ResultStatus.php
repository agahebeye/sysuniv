<?php
namespace App\Enums;

enum ResultStatus: string
{
    case PENDING = 'PENDING';
    case PASSED = 'PASSED';
    case FAILED = 'FAILED';
    case ABANDONED = 'ABANDONED';
}
