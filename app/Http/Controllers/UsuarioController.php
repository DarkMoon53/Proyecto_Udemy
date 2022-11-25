<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    
    public function configurarCuenta()
    {
        $role = Auth::user()->role->Nombre;
        $usuario = User::where("id", Auth::user()->id)->first();
        switch ($role) {
            case 'admin':
                return view("admin.configurar_cuenta", compact("usuario"));
                break;
            case 'alumno':
                return view("alumno.configurar_cuenta", compact("usuario"));
                break;
            case 'profesor':
                return view("teacher.configurar_cuenta", compact("usuario"));
                break;
        }
    }

    public function procesarConfigurarCuenta(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "apellido" => ['required', 'string'],
            "Dirección" => ["required", "string"],
            "telefono" => ["required", "string"],
            "id_usuario" => ["required"],
        ]);

        $usuario = User::where("id", $request->input("id_usuario"))->first();
        $usuario->name = $request->input("name");
        $usuario->email = $request->input("email");
        $usuario->password = bcrypt($request->input("password"));
        $usuario->apellido = $request->input("apellido");
        $usuario->Dirección = $request->input("Dirección");
        $usuario->telefono = $request->input("telefono");
        $usuario->save();

        return redirect()->back()
        ->with("success", "Datos Actualizados Correctamente")
        ->with(compact("usuario"));
    }
}
