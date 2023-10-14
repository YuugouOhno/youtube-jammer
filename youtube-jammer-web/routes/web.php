<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuizController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\CardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(WordController::class)->middleware(['auth'])->group(function(){
    Route::get('/words/index', 'index')->name('word.index');
    Route::post('/words/store', 'store')->name('word.store');
    Route::get('/words/create', 'create')->name('word.create');
    Route::get('/words/{word}', 'show')->name('word.show');
    Route::put('/words/{word}', 'update')->name('word.update');
    Route::delete('/words/{word}', 'destroy')->name('word.destroy');
    Route::get('/words/{word}/edit', 'edit')->name('word.edit');
});

Route::controller(QuizController::class)->middleware(['auth'])->group(function(){
    Route::get('/quiz/index', 'index')->name('quiz.index');
    Route::post('/quiz/store', 'store')->name('quiz.store');
    Route::get('/quiz/selectmode', 'selectmode')->name('quiz.selectmode');
    
});

Route::controller(CardController::class)->middleware(['auth'])->group(function(){
    Route::get('/cards', 'index')->name('card');
    Route::get('/cards/create', 'create')->name('card.create');
    Route::get('/cards/show', 'show')->name('card.show');
    
    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
