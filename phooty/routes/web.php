<?php

use Illuminate\Support\Facades\Route;

// impostiamo una Route che si mette in ascolto delle GET request alla pagina '/', quando questa viene visitata esegue la function
Route::get('/', function () {
    return view('home'); // le views sono contenute nella cartella resources/views
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
  return view('contact');
});

Route::get('/foo', function () {
    return ['foo' => 'bat']; //this will be parsed into json
});
