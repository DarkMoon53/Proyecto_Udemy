<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CurseCategory;
use App\Models\CurseSection;
use App\Models\Grade;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CursosController extends Controller
{
    public function index()
    {
        $categorias = Category::all();
        $idCategoria = 0;
        $cursos = Grade::all();
        return view("home", compact("categorias", "cursos", "idCategoria"));
    }

    public function verCursosPorCategoria(Request $request)
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

        return view("home", compact("categorias", "cursos", "idCategoria"));
    }

    public function cursos()
    {
        $cursos = Grade::where("id_profesor", auth()->user()->id)->get();
        return view("teacher.cursos", compact("cursos"));
    }

    public function crearCurso()
    {
        $categorias = Category::all();
        return view("teacher.crear_curso", compact("categorias"));
    }

    public function registrarCurso(Request $request)
    {
        $request->validate(
            [
                "id_categoria" => "required",
                "Nombre" => "required",
                "Descripcion" => "required",
                "Precio" => "required",
                "Idioma" => "required",
                "Requisitos" => "required",
                "Objetivos" => "required",
                "img" => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ],
            [
                "id_categoria.required" => "La categor??a es requerida",
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripci??n es requerida",
                "Precio.required" => "El precio es requerido",
                "Idioma.required" => "El idioma es requerido",
                "Requisitos.required" => "Los requisitos es requerido",
                "Objetivos.required" => "La ojetivos es requerido",
                "img.required" => "Seleccione suna imagen porfavor"
            ]
        );

        $curso = new Grade();
        $curso->Nombre = $request->input("Nombre");
        $curso->Descripcion = $request->input("Descripcion");
        $curso->Precio = (float)$request->input("Precio");
        $curso->Idioma = $request->input("Idioma");
        $curso->Requisitos = $request->input("Requisitos");
        $curso->Objetivos = $request->input("Objetivos");
        $curso->id_profesor = auth()->user()->id;
        $curso->save();

        $imageName = $curso->id.'.'.$request->img->extension();  
        $request->img->move(public_path('images'), $imageName);

        $curso->img = $imageName;
        $curso->save();

        $curseCategory = new CurseCategory();
        $curseCategory->id_curso = $curso->id;
        $curseCategory->id_categoria = (int)$request->input("id_categoria");
        $curseCategory->save();

        return redirect()->back()->with("success", "Curso registrado correctamente");
    }

    public function editarCurso(Request $request, $idCurso)
    {
        $curso = Grade::where("id", $idCurso)->first();
        $cursoCategoria = CurseCategory::where("id_curso", $curso->id)->first();
        $categorias = Category::all();
        return view("teacher.editar_curso", compact("curso", "cursoCategoria", "categorias"));
    }

    public function procesarEditarCurso(Request $request)
    {
        $request->validate(
            [
                "id_categoria" => "required",
                "Nombre" => "required",
                "Descripcion" => "required",
                "Precio" => "required",
                "Idioma" => "required",
                "Requisitos" => "required",
                "Objetivos" => "required",
            ],
            [
                "id_categoria.required" => "La categor??a es requerida",
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripci??n es requerida",
                "Precio.required" => "El precio es requerido",
                "Idioma.required" => "El idioma es requerido",
                "Requisitos.required" => "Los requisitos es requerido",
                "Objetivos.required" => "La ojetivos es requerido",
            ]
        );

        $curso = Grade::find($request->input("id_curso"));
        $curso->Nombre = $request->input("Nombre");
        $curso->Descripcion = $request->input("Descripcion");
        $curso->Precio = (float)$request->input("Precio");
        $curso->Idioma = $request->input("Idioma");
        $curso->Requisitos = $request->input("Requisitos");
        $curso->Objetivos = $request->input("Objetivos");
        $curso->save();

        if ($request->img)
        {
            File::delete(public_path("images") . "/". $curso->img);
            $imageName = $curso->id.'.'.$request->img->extension();  
            $request->img->move(public_path('images'), $imageName);
            $curso->img = $imageName;
            $curso->save();
        }

        $curseCategory = CurseCategory::where("id_curso", $curso->id)->first();
        $curseCategory->id_categoria = (int)$request->input("id_categoria");
        $curseCategory->save();

        return redirect()->back()->with("success", "Curso editado correctamente");
    }

    public function eliminarCurso(Request $request, $idCurso)
    {
        $curse_section = CurseSection::where("id_curso", $idCurso)->get();

        if (count($curse_section) > 0) {
            return redirect()->back()->with('error', "No se puede eliminar curso ya que este cuenta con secciones");
        }
        CurseCategory::where("id_curso", $idCurso)->delete();
        $curso = Grade::where("id", $idCurso)->first();
        File::delete(public_path("images") . "/". $curso->img);
        $curso->delete();
        return redirect()->back()->with("success", "Curso eliminado correctamente");
    }

    public function verCursoIndividual(Request $request, $idCurso)
    {
        $curso = Grade::where("id", $idCurso)->first();
        $profesor = User::where("id", $curso->id_profesor)->first();
        $secciones = DB::table("sections")
        ->join("course_sections", "sections.id", "=", "course_sections.id_seccion")
        ->where("course_sections.id_curso", "=", $curso->id)
        ->select("sections.*")
        ->get();

        foreach($secciones as $sec)
        {
            $sec->lecciones = Lesson::where("id_seccion", $sec->id)->get();
        }
    
        return view("alumno.ver_curso", compact("curso", "profesor", "secciones"));
    }

    public function verCursoGeneral(Request $request, $idCurso)
    {
        $curso = Grade::where("id", $idCurso)->first();
        $profesor = User::where("id", $curso->id_profesor)->first();
        $secciones = DB::table("sections")
        ->join("course_sections", "sections.id", "=", "course_sections.id_seccion")
        ->where("course_sections.id_curso", "=", $curso->id)
        ->select("sections.*")
        ->get();

        foreach($secciones as $sec)
        {
            $sec->lecciones = Lesson::where("id_seccion", $sec->id)->get();
        }
        return view("ver_curso", compact("curso", "profesor", "secciones"));
    }
}
