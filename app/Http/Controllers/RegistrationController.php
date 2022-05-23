<?php

use Inertia\Inertia;

class RegistrationController
{
    public function create(): \Inertia\Response {
        return Inertia::render('registrations/create');
    }
}
