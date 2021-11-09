<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogInController extends Controller
{
    //
    public function index()
    {
    //   $projects = Project::where('is_completed', false)
    //                       ->orderBy('created_at', 'desc')
    //                       ->withCount(['tasks' => function ($query) {
    //                         $query->where('is_completed', false);
    //                       }])
    //                       ->get();

    $projects = Project::where('email', 'email@stio.kl')
                          ->orderBy('created_at', 'desc')
                          ->withCount(['tasks' => function ($query) {
                            $query->where('is_completed', false);
                          }])
                          ->get();
  
      return $projects->toJson();
    }
  
    
  
    public function show($id)
    {
      $user = User::with(['uploads' => function ($query) {
        $query->where('user_id', '288');
      }])->find($id);
  
      return $user->toJson();
    }
  
    // public function markAsCompleted(Project $project)
    // {
    //   $project->is_completed = true;
    //   $project->update();
  
    //   return response()->json('Project updated!');
    // }

    /**
     * login user to our application
     */
    public function loginUser(Request $request){
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){
            //generate the token for the user
            $user_login_token= auth()->user()->createToken('PassportExample@Section.io')->accessToken;
            //now return this token on success login attempt
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }
}
