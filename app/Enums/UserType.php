<?php
namespace App\Enums;

enum UserType: string {
    case ADMIN = 'ADMIN';
    case EMPLOYEE = 'EMPLOYEE';
    case UNIVERSITY = 'UNIVERSITY';
}