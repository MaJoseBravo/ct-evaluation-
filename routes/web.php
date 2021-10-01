<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Generic;
use App\Http\Controllers\PrimeraFaseController;
use App\Http\Controllers\TerceraFaseController;

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
    $questions = [
        'phase_1' => collect(range(1, 15))->map(function($index){
            $routeName = "question-1.{$index}";

            return [
                'value' => $routeName,
                'text' => "Pregunta $index",
                'route' => route($routeName),
            ];
        }),

        'phase_2' => collect(range(1, 2))->map(function($index){
            $routeName = "question-2.{$index}";

            return [
                'value' => $routeName,
                'text' => "Pregunta $index",
                'route' => route($routeName),
            ];
        }),

        'phase_3' => collect(range(1, 1))->map(function($index){
            $routeName = "question-3.{$index}";

            return [
                'value' => $routeName,
                'text' => "Pregunta $index",
                'route' => route($routeName),
            ];
        }),
    ];

    return view('home', compact('questions'));
});

Route::get('/questions/1.1', [PrimeraFaseController::class, 'BloqueUno'])->name('question-1.1');
Route::get('/questions/1.2', [PrimeraFaseController::class, 'BloqueDos'])->name('question-1.2');
Route::get('/questions/1.3', [Generic::class, 'index'])->name('question-1.3');
Route::get('/questions/1.4', [Generic::class, 'index'])->name('question-1.4');
Route::get('/questions/1.5', [Generic::class, 'index'])->name('question-1.5');
Route::get('/questions/1.6', [Generic::class, 'index'])->name('question-1.6');
Route::get('/questions/1.7', [Generic::class, 'index'])->name('question-1.7');
Route::get('/questions/1.8', [Generic::class, 'index'])->name('question-1.8');
Route::get('/questions/1.9', [Generic::class, 'index'])->name('question-1.9');
Route::get('/questions/1.10', [Generic::class, 'index'])->name('question-1.10');
Route::get('/questions/1.11', [Generic::class, 'index'])->name('question-1.11');
Route::get('/questions/1.12', [Generic::class, 'index'])->name('question-1.12');
Route::get('/questions/1.13', [Generic::class, 'index'])->name('question-1.13');
Route::get('/questions/1.14', [Generic::class, 'index'])->name('question-1.14');
Route::get('/questions/1.15', [Generic::class, 'index'])->name('question-1.15');


Route::get('/questions/2.1', [PrimeraFaseController::class, 'PreguntaUno'])->name('question-2.1');
Route::get('/questions/2.2', [PrimeraFaseController::class, 'PreguntaUno'])->name('question-2.2');
Route::get('/questions/3.1', [PrimeraFaseController::class, 'PreguntaUno'])->name('question-3.1');


Route::get('/ProblemaRana', [TerceraFaseController::class, 'ProblemaRana'])->name('ProblemaRana');