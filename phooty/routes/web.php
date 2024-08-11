<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

// impostiamo una Route che si mette in ascolto delle GET request alla pagina '/', quando questa viene visitata esegue la function
Route::get('/', function () {
  return view('home');
});

// Index
Route::get('/jobs', function () {
  $jobs = Job::with('employer')->latest()->simplePaginate(3);
  return view('jobs.index', ['jobs' => $jobs]);
});

// Create
Route::get('/jobs/create', function () {
  return view('jobs.create');
});

// Show
// laravel capisce che i valori passati tra parentesi sono delle variabili e le passa direttamente alla funzione
Route::get('/jobs/{id}', function ($id) {
  $job = Job::find($id);
  return view('jobs.show', ['job' => $job]);
});

// Store
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

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
  $job = Job::find($id);
  return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
  // validate
  request()->validate([
    'title' => ['required', 'min:3'],
    'salary' => ['required']
  ]);

  // authorize
  // update the job
  $job = Job::findOrFail($id); // to not manually fetch the job from the DB but let the framework working instead, see Laravel Route Model Binding
  $job->title = request('title');
  $job->salary = request('salary');
  $job->save();

  // persist
  // the same as above
//  $job->update([
//    'title' => request('title'),
//    'salary' => request('salary')
//  ]);
  // redirect to the job page
  return redirect('/jobs/' . $job->id);
});

// Delete
Route::delete('/jobs/{id}', function ($id) {
  // authorize
  // delete the job
  $job = Job::findOrFail($id);
  $job->delete();
  // redirect
  return redirect('/jobs');
});

Route::get('/contact', function () {
  return view('contact');
});
