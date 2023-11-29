<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
   
    public function create()
    {
        $classrooms = Classroom::get(['id', 'name']);

        return Inertia::render('Student/Create', [
            'classrooms' => $classrooms
        ]);
    }

    public function store(StudentRequest $request)
    {
        // dd($request->all());

        try {
            Student::create([
                'classroom_id' => $request->input('classroom_id'),
                'name' => $request->input('name'),
                'birth' => $request->input('birth'),
                'sex' => $request->input('sex')['name'],
                'cpf' => $request->input('cpf'),
                'address' => $request->input('address'),
            ]);;

            return redirect()->back()->with('success', 'Aluno criado com sucesso!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao criar Aluno.');
        }
    }

    public function students()
    {
        $students = Student::with('classroom')->get();
        
        return Inertia::render('Student/Students', [
            'students' =>  $students
        ]);
    }
}
