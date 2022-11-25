<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function home()
    {
        return view("admin.dashboard");
    }

    public function listarUsuarios()
    {
        $usuarios = User::all();
        return view("admin.usuarios", compact("usuarios"));
    }

    public function darBajaUsuario(Request $request)
    {
        $idUser = $request->input("id_usuario");
        $usuario = User::where("id", $idUser)->first();
        $usuario->estado = 0;
        $usuario->save();

        return redirect()->route("admin.usuarios");
    }

    public function activarUsuario(Request $request)
    {
        $idUser = $request->input("id_usuario");
        $usuario = User::where("id", $idUser)->first();
        $usuario->estado = 1;
        $usuario->save();

        return redirect()->route("admin.usuarios");
    }
}
