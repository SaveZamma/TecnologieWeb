<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
  public function create()
  {
    return view('auth.register');
  }

  public function store()
  {
    // validate -> see also laravel.com/docs/validation
    $attribute = request()->validate([
      'first_name'=>['required','string'],
      'last_name'=>['required','string'],
      'email'=>['required','email','unique:users,email'],
      'password'=>['required',Password::min(6), 'confirmed']
      // confirmed tells laravel to check for an attribute named xxx_confirmation that must match the original
    ]);
    // create a user
    $user = User::create($attribute);

    // log in
    Auth::login($user);

    // redirect somewhere
    return redirect('/jobs');
  }
}
