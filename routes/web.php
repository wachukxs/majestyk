<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(); // ??
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/{path?}/dashboard', 'testapp');

Route::post('/uploads', function() {
    try {
        Log::debug('posted a pic');
        // request()->file('selectedFile')->store('all-uploads'); // stores in storage/app

        // request()->get('selectedFile')->store('all-uploads');
        
        // return response('Weldone', 200)->header('Content-Type', 'text/plain');

        return response()->json('Successfully added');


        $image = request()->get('selectedFile'); // $request->get('selectedFile');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make(request()->get('file'))->save(public_path('images/').$name);
        



        $fileupload = new Fileupload();
        $fileupload->filename=$name;
        $fileupload->save();
        return response()->json('Successfully added');
    } catch (\Throwable $th) {
        //throw $th;

        getLogger()->info('Incoming request:');
        Log::emergency('ERR:' . "\n");
        Log::alert('ERR:' . "\n");
        Log::critical('ERR:' . "\n");
        Log::error('ERR:' . "\n");
        Log::warning('ERR:' . "\n");
        Log::notice('ERR:' . "\n");
        Log::info('ERR:' . "\n");
        Log::debug('ERR:' . "\n");
        Log::info('ERR:' . "\n");
        Log::info('ERR:' . $th->getMessage());
        echo "wleklw";
        return response('Try again' . $th->getMessage(), 400)->header('Content-Type', 'text/plain');
        // return back();
    }
});

Route::get('/uploads', function () {
    return 'Hello World';
});