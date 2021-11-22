<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Generic;
use App\Http\Controllers\PersonController;

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
                'text' => "Question $index",
                'route' => route($routeName),
            ];
        }),
    ];

    return view('home', compact('questions'));
});

Route::get('/questions/1.1', [Generic::class, 'q1'])->name('question-1.1');
Route::get('/questions/1.2', [Generic::class, 'q2'])->name('question-1.2');
Route::get('/questions/1.3', [Generic::class, 'q3'])->name('question-1.3');
Route::get('/questions/1.4', [Generic::class, 'q4'])->name('question-1.4');
Route::get('/questions/1.5', [Generic::class, 'q5'])->name('question-1.5');
Route::get('/questions/1.6', [Generic::class, 'q6'])->name('question-1.6');
Route::get('/questions/1.7', [Generic::class, 'q7'])->name('question-1.7');
Route::get('/questions/1.8', [Generic::class, 'q8'])->name('question-1.8');
Route::get('/questions/1.9', [Generic::class, 'q9'])->name('question-1.9');
Route::get('/questions/1.10', [Generic::class, 'q10'])->name('question-1.10');
Route::get('/questions/1.11', [Generic::class, 'q11'])->name('question-1.11');
Route::get('/questions/1.12', [Generic::class, 'q12'])->name('question-1.12');
Route::get('/questions/1.13', [Generic::class, 'q13'])->name('question-1.13');
Route::get('/questions/1.14', [Generic::class, 'q14'])->name('question-1.14');
Route::get('/questions/1.15', [Generic::class, '15'])->name('question-1.15');

Route::post('/create_person', [PersonController::class, 'store'])->name('create_person');
