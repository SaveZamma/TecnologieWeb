<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

// impostiamo una Route che si mette in ascolto delle GET request alla pagina '/', quando questa viene visitata esegue la function
Route::get('/', function () {
  return view('home');
});

Route::get('/jobs', function () {
  $jobs = Job::with('employer')->simplePaginate(3);
  return view('jobs', ['jobs' => $jobs]);
});

// laravel capisce che i valori passati tra parentesi sono delle variabili e le passa direttamente alla funzione
Route::get('/jobs/{id}', function ($id) {
  $job = Job::find($id);
  return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
  return view('contact');
});

Route::get('/foo', function () {
  return ['foo' => 'bat']; //this will be parsed into json
});
