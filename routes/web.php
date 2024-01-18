<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
    return view('index2');
})->name("index2");

Route::get('/profile', function () {
    return view('profile');
})->name("profile");

Route::get('/email', function () {
    return view('email');
})->name("email");


Route::get('/prihlaseni', [UserController::class,'ReprezentaceUzivatelu'])->name('index')->middleware('auth');
Route::get('/profile/{id?}', [UserController::class,'UzivatelskyProfil'])->name('userprofile')->middleware('auth');
Route::get('/myprofile', [UserController::class,'MujProfil'])->name('myinformation')->middleware('auth');

Route::post('/zmenaOsobnichInformaci', [UserController::class,'NahravaniUdaju'])->name('zmenaOsobnichInformaci')->middleware('auth');

Route::post('/uploadFotografie', [UserController::class,'NahravaniFotek'])->name('uploadFotografie');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

