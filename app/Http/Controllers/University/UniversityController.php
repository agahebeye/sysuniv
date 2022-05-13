<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UniversityController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('universities/index', [
            'universities' => University::with(['photo'])->get()
        ]);
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
}
