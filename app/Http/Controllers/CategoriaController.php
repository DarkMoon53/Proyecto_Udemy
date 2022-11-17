<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function viewCategorias()
    {
        $categorias = Category::all();
        return view("admin.categorias", compact("categorias"));
    }
    public function crearCategoria()
    {
        return view("admin.crear_categoria");
    }

    public function guardarCategoria(Request $request)
    {
        $request->validate(
            [
                "Nombre" => "required",
                "Descripcion" => "required"
            ],
            [
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripción es requerida",
            ]
        );

        $categoria = new Category();
        $categoria->Nombre = $request->input("Nombre");
        $categoria->Descripcion = $request->input("Descripcion");
        $categoria->save();

        return redirect()->back()->with("success", "Categoría registrada correctamente");
    }

    public function eliminarCategoria(Request $request, $idCategoria)
    {
        Category::where('id', $idCategoria)->delete();
        return redirect()->back()->with("success", "Categoría eliminada correctamente");
    }

    public function editarCategoria(Request $request, $idCategoria)
    {
        $categoria = Category::where("id", $idCategoria)->first();
        return view("admin.editar_categoria", compact("categoria"));
    }

    public function guardarEditCategoria(Request $request)
    {
        $request->validate(
            [
                "Nombre" => "required",
                "Descripcion" => "required"
            ],
            [
                "Nombre.required" => "El nombre es requerido",
                "Descripcion.required" => "La descripción es requerida",
            ]
        );

        $categoria = Category::find($request->input("id_categoria"));
        $categoria->Nombre = $request->input("Nombre");
        $categoria->Descripcion = $request->input("Descripcion");
        $categoria->save();

        return redirect()->back()->with("success", "Categoría actualizada correctamente");
    }
}
