<?php
namespace App\Enums;

enum UserType: int {
    case REDACTEUR = 0;
    case ADMIN = 1;
}