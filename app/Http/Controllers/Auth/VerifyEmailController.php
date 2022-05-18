<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        if ($request->user('university')->hasVerifiedEmail()) {
            redirect()->intended(route('universities.show', ['university' => auth('university')->id()]).'?verified=1');
        }

        if ($request->user('university')->markEmailAsVerified()) {
            event(new Verified($request->user('university')));
        }

        return redirect()->intended(route('universities.show', ['university' => auth('university')->id()]).'?verified=1');
    }
}