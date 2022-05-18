<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use App\Models\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\UniversityLoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedUniversityController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('universities/auth/login', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UniversityLoginRequest $request)
    {
        $university = University::query()
            ->where('nom', $request->input('nom'))
            ->first();

        if ($university) {
            $request->authenticate();
        } else {
            throw ValidationException::withMessages([
                'university' => "L'université avec ce nom n'existe pas."
            ]);
        }


        $request->session()->regenerate();

        return to_route('universities.show', $university->id);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('university')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route('universities.login');
    }
}
