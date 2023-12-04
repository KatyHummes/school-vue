<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassroomController extends Controller
{
    public function create()
    {
        $schools = School::get(['id', 'name']);

        return Inertia::render('Classroom/Create', [
            'schools' => $schools
        ]);
    }

    public function store(ClassroomRequest $request)
    {
        // dd($request->all());

        try {
            Classroom::create([
                'school_id' => $request->input('school_id')['id'],
                'name' => $request->input('name'),
                'rotation' => $request->input('rotation')['name'],
                'max_students' => $request->input('max_students'),
            ]);

            return redirect()->back()->with('success', 'Turma criada com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar Turma.');
        }
    }

    public function classrooms()
    {
        $classrooms = Classroom::with('school')->get();

        return Inertia::render('Classroom/Classrooms', [
            'classrooms' =>  $classrooms
        ]);
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        $schools = School::get(['id', 'name']);

        return Inertia::render('Classroom/Edit', [
            'classroom' => $classroom,
            'schools' => $schools
        ]);
    }

    public function update(ClassroomRequest $request, $id)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->update([
            'school_id' => $request->input('school_id')['id'],
            'name' => $request->input('name'),
            'rotation' => $request->input('rotation')['name'],
            'max_students' => $request->input('max_students'),
        ]);
    }

    public function delete($id)
    {
        $classroom = Classroom::findOrFail($id);

        $classroom->delete();
    }
}
