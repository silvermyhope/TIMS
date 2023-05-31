<?php

use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/generate-token', function () {
    $user = User::find(1);
    $token = JWTAuth::fromUser($user);
    return $token;
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');
    $user = User::where('email', $credentials['email'])->first();

    if (!$user || !Hash::check($credentials['password'], $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = JWTAuth::fromUser($user);

    return response()->json(['token' => $token]);
});
