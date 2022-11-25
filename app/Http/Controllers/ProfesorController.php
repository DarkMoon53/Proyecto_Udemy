<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfesorController extends Controller
{
    public function home()
    {
        return view("teacher.dashboard");
    }

    public function alumnos()
    {
        $idCurso = 0;
        $alumnos = [];
        $cursos = Grade::where("id_profesor", auth()->user()->id)->get();
        return view("teacher.alumnos", compact("cursos", "idCurso", "alumnos"));
    }

    public function mostrarAlumnos(Request $request)
    {
        $idCurso = $request->input("id_curso");
        $alumnos = DB::table("users")
            ->join("user_course", "users.id", "=", "user_course.id_usuario")
            ->join("grades", "user_course.id_curso", "=", "grades.id")
            ->where("grades.id", "=", $idCurso)
            ->select("users.*")
            ->get();
        $cursos = Grade::where("id_profesor", auth()->user()->id)->get();
        $curso = Grade::where("id", $idCurso)->first();
        return view("teacher.alumnos", compact("cursos", "idCurso", "alumnos", "curso"));
    }

    public function verCursosMasVendidos()
    {
        $idProfesor = Auth::user()->id;
        $masVendidos = DB::table("sales")
            ->join("details_sales", "sales.id", "=", "details_sales.id_venta")
            ->join("grades", "details_sales.id_curso", "=", "grades.id")
            ->selectRaw("details_sales.id_curso, count(details_sales.id_curso) as cantidad, SUM(sales.total) as total")
            ->where("grades.id_profesor", $idProfesor)
            ->groupBy("details_sales.id_curso")
            ->orderBy("cantidad", "desc")
            ->get();

        foreach($masVendidos as $mv)
        {
            $mv->curso = Grade::where("id", $mv->id_curso)->first();
        }
        return view("teacher.cursos_mas_vendidos", compact("masVendidos"));
    }
}
