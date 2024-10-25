<?php

use Illuminate\Support\Facades\Route;

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
    return view('index');
})->name('index');

Route::get('/mss', function () {
    return view('mss');
})->name('mss');

// Route::get('/tracks', function () {
//     return view('tracks');
// })->name('tracks');

// Route::get('/track', function () {
//     return view('track');
// })->name('track');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

/////////////////////////////////////// TEAM ///////////////////////////////////////////

Route::get('/team', [App\Http\Controllers\OpenController::class, 'team'])->name('team');

Route::get('admin/team', [App\Http\Controllers\TeamController::class, 'dashy'])->name('team.dashy');

Route::get('admin/team/create', [App\Http\Controllers\TeamController::class, 'create'])->name('team.c.g');
Route::post('admin/team/create', [App\Http\Controllers\TeamController::class, 'store'])->name('team.c.p');

Route::get('admin/team/update/{id}', [App\Http\Controllers\TeamController::class, 'edit'])->name('team.u.g');
Route::post('admin/team/update/{id}', [App\Http\Controllers\TeamController::class, 'update'])->name('team.u.p');

Route::get('admin/team/delete/{id}', [App\Http\Controllers\TeamController::class, 'destroy'])->name('team.d');

/////////////////////////////////////// TRACK ///////////////////////////////////////////

Route::get('/questions', [App\Http\Controllers\QuizzController::class, 'quizz'])->name('quizz');
Route::post('/message_store', [App\Http\Controllers\MessageController::class, 'store'])->name('store');

Route::get('/intervention/index', [App\Http\Controllers\InterventionController::class, 'index'])->name('i.index');
Route::get('/intervention/create', [App\Http\Controllers\InterventionController::class, 'create'])->name('i.create');
Route::post('/intervention/store', [App\Http\Controllers\InterventionController::class, 'store'])->name('i.store');
Route::get('/intervention/{id}/edit', [App\Http\Controllers\InterventionController::class, 'edit'])->name('i.edit');
Route::put('/intervention/{id}/update', [App\Http\Controllers\InterventionController::class, 'update'])->name('i.update');
Route::delete('/intervention/{id}/destroy', [App\Http\Controllers\InterventionController::class, 'destroy'])->name('i.destroy');

Route::get('/tf/index', [App\Http\Controllers\TeacherFeedbackController::class, 'index'])->name('tf.index');
Route::get('/tf/create', [App\Http\Controllers\TeacherFeedbackController::class, 'create'])->name('tf.create');
Route::post('/tf/store', [App\Http\Controllers\TeacherFeedbackController::class, 'store'])->name('tf.store');
Route::get('/tf/{id}/edit', [App\Http\Controllers\TeacherFeedbackController::class, 'edit'])->name('tf.edit');
Route::put('/tf/{id}/update', [App\Http\Controllers\TeacherFeedbackController::class, 'update'])->name('tf.update');
Route::delete('/tf/{id}/destroy', [App\Http\Controllers\TeacherFeedbackController::class, 'destroy'])->name('tf.destroy');


Route::get('/track/{slug}', [App\Http\Controllers\OpenController::class, 'view'])->name('track');

Route::get('admin/tracks', [App\Http\Controllers\TracksController::class, 'dashy'])->name('track.dashy');

Route::get('admin/track/create', [App\Http\Controllers\TracksController::class, 'create'])->name('track.c.g');
Route::post('admin/track/create', [App\Http\Controllers\TracksController::class, 'store'])->name('track.c.p');

Route::get('admin/track/update/{id}', [App\Http\Controllers\TracksController::class, 'edit'])->name('track.u.g');
Route::post('admin/track/update/{id}', [App\Http\Controllers\TracksController::class, 'update'])->name('track.u.p');

Route::get('admin/track/delete/{id}', [App\Http\Controllers\TracksController::class, 'destroy'])->name('track.d');


Route::get('/ai/classify/{msg}', [App\Http\Controllers\AiController::class, 'intent'])->name('ai.classify');
Route::post('/ai/response/{type}/{message}', [App\Http\Controllers\AiController::class, 'ResponseFeed'])->name('ai.reponse');
Route::get('/ai/respond/{message}', [App\Http\Controllers\AiController::class, 'respond'])->name('ai.repond');