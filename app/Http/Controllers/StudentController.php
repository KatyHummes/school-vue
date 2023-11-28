<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
   
    public function create()
    {
        $students = Student::all();
        return Inertia::render('Student/Create', [
            'students' => $students
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        Student::create([
            'classroom_id' => $request->input('classroom_id'),
            'name' => $request->input('name'),
            'birth' => $request->input('birth'),
            'sex' => $request->input('sex')['name'],
            'cpf' => $request->input('cpf'),
            'address' => $request->input('address'),
        ]);
    }
}
