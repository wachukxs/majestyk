<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    //
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'email' => 'required',
        'password' => 'required',
        'name' => 'required',
      ]);
  
      $user = User::create([
        'email' => $validatedData['email'],
        'password' => $validatedData['password'],
        'name' => $validatedData['password'],
      ]);
  
      return response()->json('User created!');
    }
}
