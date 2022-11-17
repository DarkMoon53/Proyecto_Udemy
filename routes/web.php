<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfesorController;
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
    return redirect("/home");
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

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
});

Route::middleware(["auth", "role:profesor"])->group(function () {
    Route::get("/teacher_dashboard",
    [ProfesorController::class, "home"])->name("teacher.dashboard");
    Route::get("/profesor/cursos",
    [ProfesorController::class, "cursos"])->name("profesor.cursos");
});

Route::middleware(["auth", "role:alumno"])->group(function () {
    Route::get("/alumno_dashboard", [AlumnoController::class, "home"])->name("alumno.dashboard");
});
