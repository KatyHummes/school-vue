<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\School;
use App\Models\Classes;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function create()
    {
        return Inertia::render('School/Create');
    }

    public function schools()
    {
        $schools = School::all();
        return Inertia::render('School/Schools', [
            'schools' => $schools
        ]);
    }

    public function store(SchoolRequest $request)
    {
        $school = School::create([
            'name' => $request->input('name'),
            'education' => $request->input('education')['name'],
            'address' => $request->input('address'),
            'course' => $request->input('course')['name'],
        ]);

        return response()->json(['message' => 'Escola e Sala de Aula criadas com sucesso.']);
    }
}
