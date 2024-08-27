<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
  $job = \App\Models\Job::first();
  TranslateJob::dispatch($job);

  return 'done';
});

Route::view('/', 'home');
Route::view('/contact', 'contact');

//Route::controller(JobController::class)->group(function () {
//  Route::get('/jobs', 'index');
//  Route::get('/jobs/create', 'create');
//  Route::get('/jobs/{job}', 'show');
//  Route::post('/jobs', 'store');
//  Route::get('/jobs/{job}/edit', 'edit');
//  Route::patch('/jobs/{job}', 'update');
//  Route::delete('/jobs/{job}', 'destroy');
//});

// to see all routes type in terminal "php artisan route:list [--except-vendor]"
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
  ->middleware('auth')
  ->can('edit', 'job'); // Laravel search for the policy called edit, connected to the Job class

Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
