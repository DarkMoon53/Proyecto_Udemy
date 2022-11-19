<?php

namespace App\Http\Controllers;

use App\Models\AlumnoCurso;
use App\Models\DetalleVenta;
use App\Models\Grade;
use App\Models\Sale;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function comprarCursoMiddleware(Request $request, $idCurso)
    {
        if (auth()->user() == null)
        {
            return redirect()->route("home");
        }

        return redirect()->route("alummno.comprar_curso", $idCurso);

    }

    public function comprarCurso(Request $request, $idCurso)
    {
        $curso = Grade::where("id", $idCurso)->first();
        return view("alumno.comprar_curso", compact("curso"));
    }

    public function procesarCompraCurso(Request $request)
    {
        $idCurso = $request->input("id_curso");
        $curso = Grade::where("id", $idCurso)->first();

        $venta = new Sale();
        $venta->cantidaventa = 1;
        $venta->total = $curso->Precio;
        $venta->id_usuario = auth()->user()->id;
        $venta->save();

        $detalle_venta = new DetalleVenta();
        $detalle_venta->id_venta = $venta->id;
        $detalle_venta->id_curso = $curso->id;
        $detalle_venta->save();

        $alumno_curso = new AlumnoCurso();
        $alumno_curso->id_usuario = auth()->user()->id;
        $alumno_curso->id_curso = $curso->id;
        $alumno_curso->save();

        return redirect()->back()->with("success", "Curso comprado correctamente");
    }
}
