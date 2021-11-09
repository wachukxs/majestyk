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
}
