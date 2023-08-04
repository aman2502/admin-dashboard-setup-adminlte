<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin', 'as' => 'admin.'], function(){

    Route::group([
        'namespace' => 'Auth',
    ], function () {
        // Authentication Routes...
        Route::get('login', [LoginController::class,'showLoginForm'])->name('login_page');
        Route::post('login', [LoginController::class,'login'])->name('login');
        Route::post('logout', [LoginController::class,'logout'])->name('logout');
    });
      
        Route::group([
            'middleware' => [
                'auth:admin',
            ],
        ], function () {
            Route::get('/home', [HomeController::class,'index'])->name('home');
    
                Route::view('about', 'about')->name('about');
    
        Route::get('users', [\App\Http\Controllers\UserController::class, 'index'])->name('users.index');
    
        Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
        Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        }
    
            
        
    );
});
