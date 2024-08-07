<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

// impostiamo una Route che si mette in ascolto delle GET request alla pagina '/', quando questa viene visitata esegue la function
Route::get('/', function () {
  return view('home');
});

Route::get('/jobs', function () {
  $jobs = Job::with('employer')->latest()->simplePaginate(3);
  return view('jobs.index', ['jobs' => $jobs]);
});

Route::get('/jobs/create', function () {
  return view('jobs.create');
});

// laravel capisce che i valori passati tra parentesi sono delle variabili e le passa direttamente alla funzione
Route::get('/jobs/{id}', function ($id) {
  $job = Job::find($id);
  return view('jobs.show', ['job' => $job]);
});

Route::post('/jobs', function () {
  //...validation
  request()->validate([
    'title' => ['required', 'min:3'],
    'salary' => ['required']
  ]);

  Job::create([
    'title' => request('title'),
    'salary' => request('salary'),
    'employer_id' => 1
  ]);

  return redirect('/jobs');
});

Route::get('/contact', function () {
  return view('contact');
});
