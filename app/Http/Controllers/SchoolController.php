<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolRequest;
use App\Models\School;
use App\Models\Classes;
use Dotenv\Exception\ValidationException;
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
        // dd($request->all

        try {
            School::create([
                'name' => $request->input('name'),
                'education' => $request->input('education')['name'],
                'address' => $request->input('address'),
                'course' => $request->input('course')['name'],
            ]);

            return redirect()->back()->with('success', 'Escola criada com sucesso.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar Escola.');
        }
    }

    public function edit($id)
    {
        $school = School::findOrFail($id);

        return Inertia::render('School/Edit', [
            'school' =>  $school
        ]);
    }


    public function update(SchoolRequest $request, $id)
    {
        $school = School::findOrFail($id);

        $school->update([
            'name' => $request->input('name'),
            'education' => $request->input('education')['name'],
            'address' => $request->input('address'),
            'course' => $request->input('course')['name'],
        ]);
    }

    public function delete($id)
    {
        $school = School::findOrFail($id);

        $school->delete();
    }
}
