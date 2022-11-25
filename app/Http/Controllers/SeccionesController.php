<?php

namespace App\Http\Controllers;

use App\Models\CurseSection;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeccionesController extends Controller
{
    private $idCurso = null;

    public function secciones(Request $request)
    {
        $cursos = Grade::where("id_profesor", auth()->user()->id)->get();
        $idCurso = $this->idCurso;
        return view("teacher.secciones", compact("cursos", "idCurso"));
    }

    public function verSecciones(Request $request)
    {
        $cursos = Grade::all();
        $idCurso = $request->input("id_curso");
        $secciones = DB::table("sections")
                ->join("course_sections", "sections.id", "=", "course_sections.id_seccion")
                ->join("grades", "grades.id", "=", "course_sections.id_curso")
                ->where("grades.id", "=", $idCurso)
                ->select("sections.*")
                ->get();
        return view("teacher.secciones", compact("cursos", "idCurso", "secciones"));
    }

    public function crearSeccion(Request $request, $idCurso)
    {
        $curso = Grade::where("id", $idCurso)->first();
        return view("teacher.crear_seccion", compact("curso"));
    }

    public function registrarSeccion(Request $request)
    {
        $request->validate(
            [
                "id_curso" => "required",
                "Nombre" => "required",
                "Descripcion" => "required",
                "Tiempo" => "required",
            ],
            [
                "id_curso.required" => "La categoría es requerida",
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripción es requerida",
                "Tiempo.required" => "El tiempo es requerido",
            ]
        );
        $seccion = new Section();
        $seccion->Nombre = $request->input("Nombre");
        $seccion->Descripción = $request->input("Descripcion");
        $seccion->Tiempo = $request->input("Tiempo");
        $seccion->save();

        $cursoSeccion = new CurseSection();
        $cursoSeccion->id_seccion = $seccion->id;
        $cursoSeccion->id_curso = $request->input("id_curso");
        $cursoSeccion->save();

        return redirect()->back()->with("success", "Seccion registrada correctamente");
    }

    public function editarSeccion(Request $request, $idSeccion)
    {
        $seccion = Section::where("id", $idSeccion)->first();
        return view("teacher.editar_seccion", compact("seccion"));
    }

    public function procesarEditarSeccion(Request $request)
    {
        $request->validate(
            [
                "id_seccion" => "required",
                "Nombre" => "required",
                "Descripcion" => "required",
                "Tiempo" => "required",
            ],
            [
                "id_seccion.required" => "La categoría es requerida",
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripción es requerida",
                "Tiempo.required" => "El tiempo es requerido",
            ]
        );

        $seccion = Section::find($request->input("id_seccion"));
        $seccion->Nombre = $request->input("Nombre");
        $seccion->Descripción = $request->input("Descripcion");
        $seccion->Tiempo = $request->input("Tiempo");
        $seccion->save();
        
        return redirect()->back()->with("success", "Seccion editada correctamente");
    }

    public function eliminarSeccion(Request $request)
    {

        $idSeccion = $request->input("id_seccion");
        $lecciones = Lesson::where("id_seccion", $idSeccion)->get();
        if (count($lecciones) > 0) 
        {
            return redirect()->back()->with('error', "No se puede eliminar sección ya que este cuenta con lecciones");
        }

        CurseSection::where("id_seccion", $idSeccion)->delete();
        Section::where("id", $idSeccion)->delete();

        return redirect()->back()->with("Success", "Sección eliminada correctamente");
    }
}
