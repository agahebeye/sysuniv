<?php

namespace App\Http\Controllers\University;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\University;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UniversityController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('universities/index', [
            'universities' => University::with(['photo'])->get()
        ]);
    }

    public function show(): \Inertia\Response
    {
        /**@var \Illuminate\Database\Eloquent\Model $university */
        $university = request()->user('university');

        return Inertia::render('universities/dashboard', [
            'university' => $university->load(['photo'])->loadCount(['faculties', 'institutes']),
            'isVerified' => $university->email_verified_at->toDateTime(),
        ]);
    }

    public function create(): \Inertia\Response
    {
        return Inertia::render('universities/create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['string', 'required'],
            'email' => ['email', 'required'],
            'password' => ['string', 'confirmed', 'min:6'],
            'nif' => ['string', 'required', 'min:10'],
            'siteweb' => ['string', 'required', 'url'],
            'adresse' => ['string', 'required', 'string'],
        ]);

        $university = University::query()->create($data);
        $university->sendEmailVerificationNotification();

        return redirect(RouteServiceProvider::HOME);
    }

    public function edit(University $university): \Inertia\Response
    {
        return Inertia::render('universities/edit', [
            'university' => $university
        ]);
    }

    public function update(Request $request, University $university): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'nom' => ['sometimes'],
            'email' => ['sometimes', 'email'],
            'nif' => ['sometimes', 'min:10'],
            'siteweb' => ['sometimes', 'url'],
            'adresse' => ['sometimes', 'string'],
            'suspendu' => ['sometimes', 'integer']
        ]);

        $university->update($data);
        return redirect(RouteServiceProvider::HOME);
    }

    public function destroy(University $university): \Illuminate\Http\RedirectResponse
    {
        abort_unless(request()->user()->type == UserType::ADMIN, 403);
        $university->delete();
        return redirect(RouteServiceProvider::HOME);
    }
}
