<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TimetableController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\YouTubeController;
use App\Http\Controllers\TMDBController;
use App\Http\Controllers\Web3Controller;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//students
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
Route::get('/students/create',[App\Http\Controllers\StudentController::class, 'create'])->name('students.create');
Route::post('/students', [App\Http\Controllers\StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}', [App\Http\Controllers\StudentController::class, 'show'])->name('students.show');
Route::get('/students/{student}/edit', [App\Http\Controllers\StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [App\Http\Controllers\StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [App\Http\Controllers\StudentController::class, 'destroy'])->name('students.destroy');

//subjects
Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/create',[App\Http\Controllers\SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects', [App\Http\Controllers\SubjectController::class, 'store'])->name('subjects.store');
Route::get('/subjects/{subject}', [App\Http\Controllers\SubjectController::class, 'show'])->name('subjects.show');
Route::get('/subjects/{subject}/edit', [App\Http\Controllers\SubjectController::class, 'edit'])->name('subjects.edit');
Route::put('/subjects/{subject}', [App\Http\Controllers\SubjectController::class, 'update'])->name('subjects.update');
Route::delete('/subjects/{subject}', [App\Http\Controllers\SubjectController::class, 'destroy'])->name('subjects.destroy');

//timetable
Route::resource('timetables', App\Http\Controllers\TimetableController::class);
Route::get('/timetables', [App\Http\Controllers\TimetableController::class, 'index'])->name('timetables.index');
Route::get('/timetables/create',[App\Http\Controllers\TimetableController::class, 'create'])->name('timetables.create');
Route::post('/timetables', [App\Http\Controllers\TimetableController::class, 'store'])->name('timetables.store');
Route::get('/timetables/{timetable}', [App\Http\Controllers\TimetableController::class, 'show'])->name('timetables.show');
Route::get('/timetables/{timetable}/edit', [App\Http\Controllers\TimetableController::class, 'edit'])->name('timetables.edit');
Route::put('/timetables/{timetable}', [App\Http\Controllers\TimetableController::class, 'update'])->name('timetables.update');
Route::delete('/timetables/{timetable}', [App\Http\Controllers\TimetableController::class, 'destroy'])->name('timetables.destroy');

//group
Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups.index');
Route::get('/groups/create',[App\Http\Controllers\GroupController::class, 'create'])->name('groups.create');
Route::post('/groups', [App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
Route::get('/groups/{group}', [App\Http\Controllers\GroupController::class, 'show'])->name('groups.show');
Route::get('/groups/{group}/edit', [App\Http\Controllers\GroupController::class, 'edit'])->name('groups.edit');
Route::put('/groups/{group}', [App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');
Route::delete('/groups/{group}', [App\Http\Controllers\GroupController::class, 'destroy'])->name('groups.destroy');

//halls
Route::get('/halls', [App\Http\Controllers\HallController::class, 'index'])->name('halls.index');
Route::get('/halls/create', [App\Http\Controllers\HallController::class, 'create'])->name('halls.create');
Route::post('/halls', [App\Http\Controllers\HallController::class, 'store'])->name('halls.store');
Route::get('/halls/{hall}', [App\Http\Controllers\HallController::class, 'show'])->name('halls.show');
Route::get('/halls/{hall}/edit', [App\Http\Controllers\HallController::class, 'edit'])->name('halls.edit');
Route::put('/halls/{hall}', [App\Http\Controllers\HallController::class, 'update'])->name('halls.update');
Route::delete('/halls/{hall}', [App\Http\Controllers\HallController::class, 'destroy'])->name('halls.destroy'); // Ensure this line is present

//days
// Route::resource('days', App\Http\Controllers\DayController::class);
Route::get('/days', [App\Http\Controllers\DayController::class, 'index'])->name('days.index'); // Display a listing of the days
Route::get('/days/create', [App\Http\Controllers\DayController::class, 'create'])->name('days.create'); // Show the form for creating a new day
Route::post('/days', [App\Http\Controllers\DayController::class, 'store'])->name('days.store'); // Store a newly created day
Route::get('/days/{day}', [App\Http\Controllers\DayController::class, 'show'])->name('days.show'); // Display the specified day
Route::get('/days/{day}/edit', [App\Http\Controllers\DayController::class, 'edit'])->name('days.edit'); // Show the form for editing the specified day
Route::put('/days/{day}', [App\Http\Controllers\DayController::class, 'update'])->name('days.update'); // Update the specified day
Route::put('/days/{day}/edit', [App\Http\Controllers\DayController::class, 'update'])->name('days.update'); // Update the specified day
Route::delete('/days/{day}', [App\Http\Controllers\DayController::class, 'destroy'])->name('days.destroy'); // Remove the specified day

Route::get('/youtube', [App\Http\Controllers\YouTubeController::class, 'index']);

Route::get('/movies', [App\Http\Controllers\TMDBController::class, 'index']);
Route::get('/movies/search', [App\Http\Controllers\TMDBController::class, 'search']);

// Public Video Routes
Route::get('/gallery', [VideoController::class, 'publicIndex'])->name('videos.public');
Route::get('/gallery/user/{userId}', [VideoController::class, 'userGallery'])->name('videos.gallery');

// Authenticated Video Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
    Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/videos', [VideoController::class, 'store'])->name('videos.store');
    Route::get('/videos/{video}/edit', [VideoController::class, 'edit'])->name('videos.edit');
    Route::put('/videos/{video}', [VideoController::class, 'update'])->name('videos.update');
    Route::delete('/videos/{video}', [VideoController::class, 'destroy'])->name('videos.destroy');
});

// Web3 Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/web3/connect', [Web3Controller::class, 'connect'])->name('web3.connect');
    Route::post('/web3/save-wallet', [Web3Controller::class, 'saveWalletAddress'])->name('web3.save-wallet');
    Route::post('/web3/disconnect', [Web3Controller::class, 'disconnect'])->name('web3.disconnect');
});