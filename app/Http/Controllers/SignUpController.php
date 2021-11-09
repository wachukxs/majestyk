<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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


    /**
     * handle user registration request
     */
    public function registerUser(Request $request){
      print_r("hitting sign up controller", TRUE);
      Log::debug('SignUpController.registerUser');
      $this->validate($request,[
          'name'=>'required',
          'email'=>'required|email|unique:users',
          'password'=>'required|min:8',
      ]);
      $user= User::create([
          'name' =>$request->name,
          'email'=>$request->email,
          'password'=>bcrypt($request->password)
      ]);

      $access_token_example = $user->createToken('PassportExample@Section.io')->access_token;
      //return the access token we generated in the above step
      return response()->json(['token'=>$access_token_example],200);
  }
}
