<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function Create()
    {
        return Inertia::render('Create');
    }
}
