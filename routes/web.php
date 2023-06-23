<?php

use App\Http\Controllers\AdditionalHourContactController;
use App\Http\Controllers\AdditionalHourController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Redirect::route('login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth', 'user.hascontact'])->group(function () {
    
    Route::group(['prefix' => '/profile'], function() {
        Route::get('', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::group(['prefix' => '/contact'], function(){

            Route::get('', [AdditionalHourContactController::class, 'edit'])->name('profile.contact.edit');
            Route::post('', [AdditionalHourContactController::class, 'store'])->name('profile.contact.store');
    
        });

    });


    Route::group(['prefix' => '/hours'], function(){
        Route::get('', [AdditionalHourController::class, 'index'])->name('hours.index');
        Route::get('/create', [AdditionalHourController::class, 'create'])->name('hours.create');
        Route::post('', [AdditionalHourController::class, 'store'])->name('hours.store');
        Route::post('/bulk', [AdditionalHourController::class, 'updateBulk'])->name('hours.update.bulk');
        
        Route::group(['prefix' => '{additional_hour}'], function() {

            Route::get('/edit', [AdditionalHourController::class, 'edit'])->name('hours.edit');
            Route::put('', [AdditionalHourController::class, 'update'])->name('hours.update');
            Route::delete('', [AdditionalHourController::class, 'destroy'])->name('hours.delete');

        });

    });


});

require __DIR__.'/auth.php';
