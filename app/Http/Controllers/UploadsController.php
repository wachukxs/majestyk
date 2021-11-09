<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UploadsController extends Controller
{
    /**
     * This method returns authenticated user details
     */
    public function authenticatedUserDetails(){
        Log::debug('UploadsController.authenticatedUserDetails');
        //returns details
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }
}
