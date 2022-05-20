<?php
namespace App\Enums;

enum UserType: int {
    case ADMIN = 0;
    case EMPLOYEE = 1;
    case UNIVERSITY = 2;
}