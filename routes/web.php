<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SMS\CategoryController;
use App\Http\Controllers\SMS\NewSMSController;
use App\Http\Controllers\SMS\ReceiverController;
use App\Http\Controllers\SMS\SentSMSController;
use Illuminate\Support\Facades\URL;

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
    return view('auth.login');
});

Auth::routes(['register' => true]);

Route::get('/home',  [HomeController::class, 'index', 'https' => true],)->name('home');
Route::get('/home/profile', [HomeController::class, 'profile'])->name('home.profile');
Route::post('/home/update', [HomeController::class, 'update'])->name('updateroute');
Route::get('/home/change_password', [HomeController::class, 'changePassword'])->name('change_password');
Route::get('/home/receiver/category', [CategoryController::class, 'index'])->name('sms.category.index');
Route::get('/home/sms/category/create', [CategoryController::class, 'create'])->name('sms.category.create');
Route::get('/home/sms/receiver', [ReceiverController::class, 'index'])->name('sms.receiver.index');
Route::get('/home/sms/receiver/create', [ReceiverController::class, 'create'])->name('sms.receiver.create');
Route::get('/home/sms/create', [NewSMSController::class, 'newSmsFun'])->name('sms.new.sms');
Route::get('/home/sms/sent', [SentSMSController::class, 'index'])->name('sent.sms');
Route::get('/home/sms/phone', [ReceiverController::class, 'exportPhoneNumbers'])->name('phone_to_excel');

