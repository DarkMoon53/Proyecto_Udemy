<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\LeccionesController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\SeccionesController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/cursos");
});

Auth::routes();

Route::get('/home', 
[App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cursos', 
[App\Http\Controllers\CursosController::class, 'index'])->name('cursos');
Route::post('/cursos', 
[App\Http\Controllers\CursosController::class, 'verCursosPorCategoria'])->name('cursos.categoria');
Route::get("/curso/comprar/{id_curso}", [VentaController::class, "comprarCursoMiddleware"])->name("curso.comprar");
Route::get("curso/ver/{idCurso}", [CursosController::class, "verCursoGeneral"])->name("ver_curso_general");

Route::middleware(["auth", "role:admin"])->group(function () {
    Route::get("/admin_dashboard", 
    [AdminController::class, "home"])->name("admin.dashboard");
    Route::get("/admin/categorias", 
    [CategoriaController::class, "viewCategorias"])->name("admin.categorias");
    Route::get("/admin/categoria", 
    [CategoriaController::class, "crearCategoria"])->name("admin.crear_categoria");
    Route::post("/admin/categoria", 
    [CategoriaController::class, "guardarCategoria"])->name("admin.procesar_categoria");
    Route::delete("/admin/categoria/{id_categoria}", 
    [CategoriaController::class, "eliminarCategoria"])->name("admin.eliminar_categoria");
    Route::get("/admin/categoria/{id_categoria}", 
    [CategoriaController::class, "editarCategoria"])->name("admin.editar_categoria");
    Route::put("/admin/categoria",
    [CategoriaController::class, "guardarEditCategoria"])->name("admin.guardarEdit_categoria");

    Route::get("admin/configurar", [UsuarioController::class, "configurarCuenta"])
    ->name("admin.configurar_cuenta");
    Route::post("admin/configurar", [UsuarioController::class, "procesarConfigurarCuenta"])
    ->name("admin.procesar_configurar_cuenta");
});

Route::middleware(["auth", "role:profesor"])->group(function () {
    Route::get("/teacher_dashboard",
    [ProfesorController::class, "home"])->name("teacher.dashboard");

    Route::get("/profesor/cursos",
    [CursosController::class, "cursos"])->name("profesor.cursos");
    Route::get("/profesor/curso",
    [CursosController::class, "crearCurso"])->name("profesor.crear_curso");
    Route::post("/profesor/curso",
    [CursosController::class, "registrarCurso"])->name("profesor.registrar_curso");
    Route::get("/profesor/curso/{id_curso}",
    [CursosController::class, "editarCurso"])->name("profesor.editar_curso");
    Route::put("/profesor/curso",
    [CursosController::class, "procesarEditarCurso"])->name("profesor.procesarEditar_curso");
    Route::delete("/profesor/curso/{id_curso}",
    [CursosController::class, "eliminarCurso"])->name("profesor.eliminar_curso");
    
    Route::get("/profesor/secciones",
    [SeccionesController::class, "secciones"])->name("profesor.secciones");
    Route::post("/profesor/secciones",
    [SeccionesController::class, "verSecciones"])->name("profesor.ver_secciones");
    Route::get("/profesor/seccion/{id_curso}",
    [SeccionesController::class, "crearSeccion"])->name("profesor.crear_seccion");
    Route::post("/profesor/seccion",
    [SeccionesController::class, "registrarSeccion"])->name("profesor.registrar_seccion");
    Route::get("/profesor/seccion/editar/{id_seccion}",
    [SeccionesController::class, "editarSeccion"])->name("profesor.editar_seccion");
    Route::put("/profesor/seccion",
    [SeccionesController::class, "procesarEditarSeccion"])->name("profesor.procesarEditar_seccion");
    Route::delete("/profesor/seccion",
    [SeccionesController::class, "eliminarSeccion"])->name("profesor.eliminar_seccion");
    
    Route::get("/profesor/seccion/lecciones/{id_seccion}",
    [LeccionesController::class, "lecciones"])->name("profesor.lecciones");
    Route::get("/profesor/seccion/leccion/{id_seccion}",
    [LeccionesController::class, "crearLeccion"])->name("profesor.crear_leccion");
    Route::post("/profesor/seccion/leccion",
    [LeccionesController::class, "registrarLeccion"])->name("profesor.registrar_leccion");
    Route::delete("/profesor/seccion/leccion/{id_leccion}",
    [LeccionesController::class, "eliminarLeccion"])->name("profesor.eliminar_leccion");
    Route::get("/profesor/seccion/leccion/editar/{id_leccion}",
    [LeccionesController::class, "editarLeccion"])->name("profesor.editar_leccion");
    Route::put("/profesor/seccion/leccion",
    [LeccionesController::class, "procesarEditarLeccion"])->name("profesor.procesarEditar_leccion");
    Route::get("/profesor/seccion/leccion/ver/{id_leccion}",
    [LeccionesController::class, "verLeccion"])->name("profesor.ver_leccion");

    Route::get("profesor/configurar", [UsuarioController::class, "configurarCuenta"])
    ->name("profesor.configurar_cuenta");
    Route::post("profesor/configurar", [UsuarioController::class, "procesarConfigurarCuenta"])
    ->name("profesor.procesar_configurar_cuenta");
});

Route::middleware(["auth", "role:alumno"])->group(function () {
    Route::get("/alumno_dashboard", [AlumnoController::class, "home"])->name("alumno.dashboard");

    Route::get("alumno/curso/comprar/{id_curso}", [VentaController::class, "comprarCurso"])->name("alumno.comprar_curso");
    Route::post("alumno/curso/comprar", [VentaController::class, "procesarCompraCurso"])->name("alumno.procesarCompra_curso");
    Route::get("alumno/curso/ver/{idCurso}", [CursosController::class, "verCursoIndividual"])
    ->name("alumno.ver_curso");

    Route::get("alumno/cursos", [AlumnoController::class, "cursos"])->name("alumno.cursos");
    Route::post("alumno/cursos", [AlumnoController::class, "cursosPorCategoria"])->name("alumno.cursos_categoria");
    Route::delete("alumno/curso", [AlumnoController::class, "darBajaCurso"])->name("alumno.darbaja_curso");
    Route::get("alumno/miscursos", [AlumnoController::class, "misCursos"])->name("alumno.miscursos");

    Route::get("alumno/miscursos/secciones/{id_curso}", [AlumnoController::class, "iniciarSecciones"])->name("alumno.miscursos_secciones");
    Route::get("alumno/miscursos/secciones/lecciones/{id_seccion}", [AlumnoController::class, "iniciarLecciones"])->name("alumno.miscursos_lecciones");
    Route::get("alumno/miscursos/secciones/lecciones/ver/{id_leccion}", [AlumnoController::class, "verLeccion"])->name("alumno.miscursos_ver_leccion");

    Route::get("alumno/configurar", [UsuarioController::class, "configurarCuenta"])
    ->name("alumno.configurar_cuenta");
    Route::post("alumno/configurar", [UsuarioController::class, "procesarConfigurarCuenta"])
    ->name("alumno.procesar_configurar_cuenta");
});
