<?php

namespace App\Http\Controllers;

use App\Models\AlumnoCurso;
use App\Models\Category;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    public function home()
    {
        return view("alumno.dashboard");
    }

    public function cursos()
    {
        $categorias = Category::all();
        $idCategoria = 0;
        $cursos = Grade::all();
        return view("alumno.cursos", compact("categorias", "cursos", "idCategoria"));
    }

    public function cursosPorCategoria(Request $request)
    {
        $categorias = Category::all();
        $idCategoria = $request->input("id_categoria");

        if ($idCategoria == 0) {
            $cursos = Grade::all();
        } else {
            $cursos = DB::table("grades")
                ->join("course_category", "grades.id", "=", "course_category.id_curso")
                ->where("course_category.id_categoria", "=", $idCategoria)
                ->select("grades.*")
                ->get();
        }

        return view("alumno.cursos", compact("categorias", "cursos", "idCategoria"));
    }

    public function misCursos()
    {
        $cursos = DB::table("grades")
                ->join("user_course", "grades.id", "=", "user_course.id_curso")
                ->where("user_course.id_usuario", "=", auth()->user()->id)
                ->select("grades.*")
                ->get();
        return view("alumno.mis_cursos", compact("cursos"));
    }

    public function iniciarSecciones(Request $request, $idCurso)
    {
        $curso = Grade::where("id", $idCurso)->first();
        $profesor = DB::table("users")
        ->join("grades", "users.id", "=", "grades.id_profesor")
        ->where("grades.id", "=", $idCurso)
        ->select("users.*")
        ->first();
        
        $secciones = DB::table("sections")
        ->join("course_sections", "sections.id", "=", "course_sections.id_seccion")
        ->where("course_sections.id_curso", "=", $curso->id)
        ->select("sections.*")
        ->get();

        return view("alumno.curso_secciones", compact("curso", "secciones", "profesor"));
    }

    public function iniciarLecciones(Request $request, $idSeccion)
    {
        $seccion = Section::where("id", $idSeccion)->first();
        $lecciones = Lesson::where("id_seccion", $seccion->id)->get();
        return view("alumno.curso_lecciones", compact("seccion", "lecciones"));
    }

    public function verLeccion(Request $request, $idLeccion)
    {
        $leccion = Lesson::where("id", $idLeccion)->first();
        return view("alumno.ver_leccion", compact("leccion"));
    }

    public function darBajaCurso(Request $request)
    {
        $idCurso = $request->input("id_curso");
        AlumnoCurso::where("id_curso", $idCurso)->delete();
        return redirect()->back()->with("success", "Curso dado de baja correctamente");
    }
}
