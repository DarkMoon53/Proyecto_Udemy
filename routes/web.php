<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('miscursos', function(){
    return "Bienvenido a la pagina cursos";
});
Route::get('/categorias',function(){
    return "Bienvenido a la pagina categorias";
});
Route::get('/nosotros',function(){
    return "Bienvenido a la nosotros";
});
Route::get('/enseñacurso',function(){
    return "Bienvenido a la pagina para ser docente";
});
Route::get('/desarrollo',function(){
    return "Bienvenido a la categoria desarrollo";
});
Route::get('/negocios',function(){
    return "Bienvenido a la categoria negocios";
});
Route::get('/software',function(){
    return "Bienvenido a la categoria sotware";
});
Route::get('/diseño',function(){
    return "Bienvenido a la categoria diseño";
});
Route::get('/marketing',function(){
    return "Bienvenido a la categoria marketing";
});

