<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\CategoryController;


    Route::get('/', function () {
        return view('welcome');
    });
    
    // 대쉬보드 앞으로 글과 사진 보여주는 칸
    Route::get('/dashboard', function () {
    return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    // 미들웨어
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    //실시간 글 작성
    Route::resource('tasks', TaskController::class)
        ->only(['index', 'store','edit','update','destroy'])
        ->middleware(['auth', 'verified']);
    
    // 개인 글 작성
    Route::resource('managements', ManagementController::class)
        ->only(['index','create', 'show', 'store', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);
    
    // 카테고리 
    Route::resource('categorys', CategoryController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);


    

require __DIR__.'/auth.php';
