<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class LeccionesController extends Controller
{
    public function lecciones(Request $request, $idSeccion)
    {
        $seccion = Section::where("id", $idSeccion)->first();
        $lecciones = Lesson::where("id_seccion", $idSeccion)->get();
        return view("teacher.lecciones", compact("seccion", "lecciones"));
    }

    public function crearLeccion(Request $request, $idSeccion)
    {
        $seccion = Section::where("id", $idSeccion)->first();
        return view("teacher.crear_leccion", compact("seccion"));
    }

    public function registrarLeccion(Request $request)
    {
        $this->validate($request, [
            'Nombre' => 'required|string|max:255',
            'video' => 'required|file|mimetypes:video/mp4',
            'id_seccion' => 'required',
        ]);

        $user = Auth::user();
        $ruta = $this->crearDirectorio($user->id, $request->input("id_seccion"));

        $leccion = new Lesson();
        $leccion->Nombre = $request->input("Nombre");
        $leccion->id_seccion = $request->input("id_seccion");

        // guardando el video
        $filePath = $ruta . "/" . $request->input("Nombre") . ".mp4";
        $isFileUploaded = Storage::disk('my_files')->put($filePath, file_get_contents($request->video));

        // guardando la ruta del video
        $leccion->ruta = $ruta;
        // sacando e tiempo de diracion del video
        $getID3 = new \getID3;
        $video_file = $getID3->analyze(public_path() . "/" . $filePath);
        $duracion_video = $video_file['playtime_string'];

        $leccion->Tiempo = $duracion_video;
        $leccion->save();

        return redirect()->back()->with("success", "Leccion registrada correctamente");
    }

    private function crearDirectorio($userId, $idSeccion)
    {
        $ruta = "videos/" . (string)$userId . "/" . (string)$idSeccion;
        $path = public_path() . "/" . $ruta;
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        return $ruta;
    }

    public function eliminarLeccion(Request $request, $idLeccion)
    {
        $leccion = Lesson::where('id', $idLeccion)->first();
        File::delete(public_path() . "/" . $leccion->ruta . "/" . $leccion->Nombre . ".mp4");
        $leccion->delete();
        return redirect()->back()->with("success", "Lección eliminada correctamente");
    }

    public function editarLeccion(Request $request, $idLeccion)
    {
        $leccion = Lesson::where("id", $idLeccion)->first();
        $pathVideo = public_path() . "/" . $leccion->ruta . "/" . $leccion->Nombre . ".mp4";
        $url = Storage::disk("my_files")->url($pathVideo);
        return view("teacher.editar_leccion", compact("leccion", "url"));
    }

    public function procesarEditarLeccion(Request $request)
    {
        $this->validate($request, [
            'Nombre' => 'required|string|max:255',
            'id_leccion' => 'required',
        ]);

        $leccion = Lesson::where("id", $request->input("id_leccion"))->first();

        $filePath = "";
        $ruta = $leccion->ruta;
        $duracion_video = $leccion->Tiempo;

        if ($request->hasFile("video")) {
            File::delete(public_path() . "/" . $leccion->ruta . "/" . $leccion->Nombre . ".mp4");
            $leccion->Nombre = $request->input("Nombre");
            $filePath = $ruta . "/" . $request->input("Nombre") . ".mp4";
            $isFileUploaded = Storage::disk('my_files')->put($filePath, file_get_contents($request->video));

            $getID3 = new \getID3;
            $video_file = $getID3->analyze(public_path() . "/" . $filePath);
            $duracion_video = $video_file['playtime_string'];
        } else {
            $filePath = $ruta . "/" . $leccion->Nombre . ".mp4";
            $filePathNew = $ruta . "/" . $request->input("Nombre") . ".mp4";
            Storage::disk("my_files")->move($filePath, $filePathNew);
            $leccion->Nombre = $request->input("Nombre");
        }
        $leccion->Tiempo = $duracion_video;
        $leccion->save();

        return redirect()->back()->with("success", "Leccion actualizada correctamente");
    }

    public function verLeccion(Request $request, $idLeccion)
    {
        $leccion = Lesson::where("id", $idLeccion)->first();
        return view("teacher.ver_leccion", compact("leccion"));
    }
}
