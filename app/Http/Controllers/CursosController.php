<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CurseCategory;
use App\Models\CurseSection;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;

class CursosController extends Controller
{
    public function cursos()
    {
        $cursos = Grade::all();
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
            ],
            [
                "id_categoria.required" => "La categoría es requerida",
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripción es requerida",
                "Precio.required" => "El precio es requerido",
                "Idioma.required" => "El idioma es requerido",
                "Requisitos.required" => "Los requisitos es requerido",
                "Objetivos.required" => "La ojetivos es requerido",
            ]
        );

        $curso = new Grade();
        $curso->Nombre = $request->input("Nombre");
        $curso->Descripcion = $request->input("Descripcion");
        $curso->Precio = (float)$request->input("Precio");
        $curso->Idioma = $request->input("Idioma");
        $curso->Requisitos = $request->input("Requisitos");
        $curso->Objetivos = $request->input("Objetivos");
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
                "id_categoria.required" => "La categoría es requerida",
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripción es requerida",
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

        $curseCategory = CurseCategory::where("id_curso", $curso->id)->first();
        $curseCategory->id_categoria = (int)$request->input("id_categoria");
        $curseCategory->save();

        return redirect()->back()->with("success", "Curso editado correctamente");
    }

    public function eliminarCurso(Request $request, $idCurso)
    {
        $curse_section = CurseSection::where("id_curso", $idCurso)->get();

        if (count($curse_section) > 0) 
        {
            return redirect()->back()->with('error', "No se puede eliminar curso ya que este cuenta con secciones");
        }
        CurseCategory::where("id_curso", $idCurso)->delete();
        Grade::where("id", $idCurso)->delete();
        return redirect()->back()->with("success", "Curso eliminado correctamente");
    }
}
