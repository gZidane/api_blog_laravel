<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Rutas para los articulos o entradas
Route::get('/articles', 'App\Http\Controllers\ArticleController@index');
Route::post('/articles', 'App\Http\Controllers\ArticleController@store');
Route::get('/articles/{article}', 'App\Http\Controllers\ArticleController@show');
Route::put('/articles/{article}', 'App\Http\Controllers\ArticleController@update');
Route::delete('/articles/{article}', 'App\Http\Controllers\ArticleController@destroy');

// Rutas para los autores
Route::get('/authors', 'App\Http\Controllers\AuthorController@index');

// Ruta para obtener todos los articulos de un autor en específico
Route::post('/author/articles', 'App\Http\Controllers\AuthorController@articles');

// Ruta para obtener los articulos relacionados a la búsqueda de los usuarios por autor, titulo o contenido
Route::post('/articles/search', 'App\Http\Controllers\ArticleController@search');