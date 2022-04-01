<?php

use App\Http\Controllers\EditDoctorController;
use App\Http\Controllers\PatientListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\DoctorListController;
use App\Http\Controllers\MakeDoctorController;
use App\Http\Controllers\DateController;
use App\Models\Doctor;

Route::get('/', function(){
  return view('home');
})->name('home');


//------all_users
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard')->middleware('auth');
    Route::post('/Date',[DateController::class,'store'])->name('Date');
    Route::get('/DoctorList', [DoctorListController::class,'index'])->name('DoctorList');
    Route::post('/DoctorList', [DoctorListController::class,'store']);
    Route::get('/DoctorList/sort', [DoctorListController::class,'sort'])->name('DoctorSort');
    Route::post('/DoctorList/sort', [DoctorListController::class,'sort'])->name('DoctorSort');
    Route::get('/Card', [CardController::class,'index'])->name('Card');
});
//---------------

//------Doctors
Route::group(['middleware' => ['auth:doctor']], function () {
    Route::get('/doctordashboard', [DashboardController::class,'index2'])->name('doctordashboard');

    Route::get('/WriteCard', [CardController::class,'index2'])->name('WriteCard');
    Route::post('/WriteCard', [CardController::class,'store']);
    Route::get('/WriteCard/{id}', [CardController::class,'edit'])->name('EditCard');
    Route::patch('/WriteCard/{id}',[CardController::class,'update'])->name('EditCard2');
    Route::delete('/WriteCard',[CardController::class,'destroy'])->name('DeleteCard');

//    Route::get('/WriteCard', [CardController::class,'index2'])->name('WriteCard');
//    Route::post('/WriteCard', [CardController::class,'store']);
});
//-------------

//-----------admin
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/MakeDoctor', [MakeDoctorController::class, 'index'])->name('MakeDoctor');
    Route::post('/MakeDoctor', [MakeDoctorController::class, 'store']);
});
//----------------


//---------everyone
Route::get('/logout', [LogoutController::class,'index'])->name('logout');
Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);
Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store']);
//---------everyone
