<?php
namespace App\Http\Controllers\Institute;


use App\Http\Controllers\Controller;
use App\Models\Institute;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InstituteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('institutes/index', [
            'institutes' => Institute::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('institutes/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'unique:institutes']
        ]);

        Institute::create($data);

        return to_route('institutes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institute  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Institute $faculty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institute  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Institute $faculty)
    {
        return Inertia::render('institutes/edit', [
            'faculty' => $faculty
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institute  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institute $faculty)
    {
        $data = $request->validate([
            'nom' => ['required', 'string']
        ]);

        $faculty->update($data);

        return to_route('institutes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institute  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institute $faculty)
    {
        $faculty->delete();
        return to_route('institutes.index');
    }
}
