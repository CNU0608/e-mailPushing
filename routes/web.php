<?php

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
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    $user = \App\User::find(2);
    Mail::to($user->email)->send(new \App\Mail\welcomeToMail($user));
});
