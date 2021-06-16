<?php

// ====================== imports ================================

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignController;



// ====================== Routes ================================

Route::get('/', function () {
    return view('sign');
})->name('sign');

Route::get('signUp', function () { // gnaluc es linky dir 
    return view('signUp'); // gna es ej
});

Route::get('signIn', function () { // gnaluc es linky dir 
    return view('signIn'); // gna es ej
});

Route::get('sendPassword', function () { // gnaluc es linky dir 
    return view('sendPassword'); // gna es ej
});

Route::get('forgotPassword', function () {
    return view('forgotPassword');
})->name('forgotPassword');

Route::get('resetPassword', function () {
    return view('resetPassword');
})->name('resetPassword');


// ==================== Middleware ================================

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function () { // gnaluc es linky dir 
        return view('dashboard'); // gna es ej
    })->name('dashboard');

    Route::get('profile', function () { // gnaluc es linky dir 
        return view('profile'); // gna es ej
    })->name('profile');

    Route::get('blackboard', function () { // gnaluc es linky dir 
        return view('blackboard'); // gna es ej
    })->name('blackboard');
    
    Route::get('leave', [SignController::class, 'logout']); 
    Route::post('profile', [SignController::class, 'change']); 
});


// ===================== Controllers ============================

Route::post('signUp', [SignController::class, 'signUp']); 
Route::post('signIn', [SignController::class, 'signIn']);
Route::post('sendPassword', [SignController::class, 'sendPassword']);
