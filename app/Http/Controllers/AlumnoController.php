<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function home()
    {
        return view("alumno.dashboard");
    }
}
