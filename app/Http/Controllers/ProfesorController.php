<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfesorController extends Controller
{
    public function home()
    {
        return view("teacher.dashboard");
    }
}
