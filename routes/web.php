<?php

use App\Http\Controllers\Admin\PropertyPanelController;
use App\Http\Controllers\Admin\UserPanelController;
use App\Http\Controllers\User\FurniturePageController;
use App\Http\Controllers\User\MyPropertyController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FurniturePanelController;


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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/users/index', [UserPanelController::class, 'index'])->name('admin.users.index');
// routes/web.php
Route::delete('/admin/users/index', [UserPanelController::class, 'index'])->name('admin.users.index');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::resource('users', UserPanelController::class)
        ->only(['index', 'destroy'])
        ->names([
            'index' => 'admin.users.index',
            'destroy' => 'admin.users.destroy'
        ]);

    Route::resource('properties', PropertyPanelController::class)
        ->only(['index', 'destroy']) // Add other methods if needed (create, store, etc.)
        ->names([
            'index' => 'admin.property.index',
            'destroy' => 'admin.property.destroy'
        ]);
            Route::resource('furniture', FurniturePanelController::class)->names([
        'index' => 'admin.furniture.index',
        'destroy' => 'admin.furniture.destroy'
    ]);
});













Route::prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/properties', [PropertyPanelController::class, 'index'])
        ->name('admin.property.index');
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/properties', [MyPropertyController::class, 'index'])->name('Property.index');
    Route::get('/properties/{property}/edit', action: [MyPropertyController::class, 'edit'])->name('user.Property.edit');
    Route::get('/user/property/{property}', [MyPropertyController::class, 'show'])
        ->name('user.Property.show');
    Route::resource('property', MyPropertyController::class);

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('properties', MyPropertyController::class)->except(['destroy']); // or ->only(['index', 'show', 'create', 'store', 'edit', 'update'])

    // Or if you prefer manual routes:
    // Route::get('/properties', [MyPropertyController::class, 'index'])->name('properties.index');
    // Route::get('/properties/create', [MyPropertyController::class, 'create'])->name('properties.create');
    // Route::post('/properties', [MyPropertyController::class, 'store'])->name('properties.store');
    // Route::get('/properties/{property}', [MyPropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/{property}/edit', [MyPropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [MyPropertyController::class, 'update'])->name('properties.update');
});
});

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    // Furniture resource routes
    Route::prefix('furniture')->name('furniture.')->group(function () {
        Route::get('/furnitures', [FurniturePageController::class, 'myFurniture'])->name('myfurniture');
        Route::get('/', [FurniturePageController::class, 'index'])->name('index');
        Route::get('/create', [FurniturePageController::class, 'create'])->name('create');
        Route::post('/', [FurniturePageController::class, 'store'])->name('store');
        Route::get('/{furniture}', [FurniturePageController::class, 'show'])->name('show');
        Route::get('/{furniture}/edit', [FurniturePageController::class, 'edit'])->name('edit');
        Route::put('/{furniture}', [FurniturePageController::class, 'update'])->name('update');
        Route::delete('/{furniture}', [FurniturePageController::class, 'destroy'])->name('destroy');
    });

});

