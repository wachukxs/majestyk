<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // https://stackoverflow.com/a/48154076/9259701
use Illuminate\Support\Facades\File;


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

    // https://laracasts.com/discuss/channels/laravel/create-image-from-base64-string-laravel
    try {
        
        $image = request()->get('imagefile'); 
        Log::notice('**:' . $image . "\n");
        Log::notice('++:' . request()->get('imagetext') . "\n");

        $ext = explode('/',explode(':', substr(request()->get('imagefile'), 0, strpos(request()->get('imagefile'), ';')))[1])[1];

        $image = preg_replace("/^data:image\/[a-z]+;base64,/i", "", $image);
        $image = str_replace(' ', '+', $image);
        $imageName = uniqid('user_image_' . request()->get('imagetext')) . '.' . $ext;
        \File::put(storage_path(). '/' . $imageName, base64_decode($image));
        



        // $fileupload = new Fileupload();
        // $fileupload->filename=$name;
        // $fileupload->save();
        return response()->json('Successfully added');
    } catch (\Throwable $th) {
        //throw $th;

        // Log::emergency('ERR:' . "\n");
        // Log::alert('ERR:' . "\n");
        // Log::critical('ERR:' . "\n");
        // Log::error('ERR:' . "\n");
        // Log::warning('ERR:' . "\n");
        // Log::notice('ERR:' . "\n");
        // Log::info('ERR:' . "\n");
        // Log::debug('ERR:' . "\n");
        // Log::info('ERR:' . "\n");
        Log::error('ERR: ' . $th->getMessage());

        return response('Try again' . $th->getMessage(), 400)->header('Content-Type', 'text/plain');
        // return back();
    }
});

Route::get('/uploads', function () {
    return 'Hello World';
});