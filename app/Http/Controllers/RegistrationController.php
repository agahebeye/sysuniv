<?php
namespace App\Http\Controllers;

use Inertia\Inertia;

class RegistrationController
{
    public function create(): \Inertia\Response {
        return Inertia::render('registrations/create');
    }

    public function store() {
        return 'store a registraion';
    }
}
