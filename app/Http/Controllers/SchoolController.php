<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function create()
    {
        return Inertia::render('School/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        School::create([
            'name' => $request->input('name'),
            'course' => $request->input('course')['name'],
            'education' => $request->input('education')['name'],
            'address' => $request->input('address'),
        ]);
    }

    public function schools()
    {
        $schools = School::all();
        return Inertia::render('School/Schools', [
            'schools' => $schools
        ]);
    }
}
