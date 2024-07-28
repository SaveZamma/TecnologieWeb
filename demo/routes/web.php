<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;

// impostiamo una Route che si mette in ascolto delle GET request alla pagina '/', quando questa viene visitata esegue la function
Route::get('/', function () {
  // le views sono contenute nella cartella resources/views
  return view('home'); // i parametri passati all'interno dell'array sono disponibili come variabili all'interno delle views
});

Route::get('/jobs', function () {
  return view('jobs', [
    'jobs'=>[
      [
        'id'=>1,
        'title'=>'Human Hunter',
        'salary'=>'$100000',
      ],
      [
        'id'=>2,
        'title'=>'Human Recruiter',
        'salary'=>'$20000',
      ],
      [
        'id'=>3,
        'title'=>'Human Butcher',
        'salary'=>'$40000',
      ]
    ]
  ]);
});

// laravel capisce che i valori passati tra parentesi sono delle variabili e le passa direttamente alla funzione
Route::get('/jobs/{id}', function ($id) {
  $jobs = [
    [
      'id' => 1,
      'title' => 'Human Hunter',
      'salary' => '$100000',
    ],
    [
      'id' => 2,
      'title' => 'Human Recruiter',
      'salary' => '$20000',
    ],
    [
      'id' => 3,
      'title' => 'Human Butcher',
      'salary' => '$40000',
    ]
  ];

  $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);
//  dd($job); // dd() stands for dumb and die

  return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
  return view('contact');
});

Route::get('/foo', function () {
  return ['foo' => 'bat']; //this will be parsed into json
});
