<?php

use App\Http\Controllers\Admin\Admincontroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Todocontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(UserMiddleware::class)->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    Route::get('/show',[Todocontroller::class,'show'])->middleware(UserMiddleware::class)->name('show');
    Route::get('/create',[Todocontroller::class,'create'])->name('create');
    Route::post('/store',[Todocontroller::class,'store'])->name('store');
    Route::get('todo/{id}/edit',[Todocontroller::class,'edit']);
    Route::put('todo/{id}/update',[Todocontroller::class,'update'])->name('update');
    
    Route::get('todo/{id}/delete',[Todocontroller::class,'delete']);
    Route::get('todo/{id}/view',[Todocontroller::class,'view']);

});    


Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/login',[Admincontroller::class,'index'])->name('login');
    Route::post('/login',[Admincontroller::class,'login']);

    Route::get('/dashboard',function ()
    {
        return view('admin.dashboard');
    })->middleware(AdminMiddleware::class)->name('dashboard');

});
Route::get('/admin/show',[Admincontroller::class,'show'])->middleware(AdminMiddleware::class)->name('show');

Route::get('/admin/user',[Admincontroller::class,'user_show'])->middleware(AdminMiddleware::class)->name('user_show');



require __DIR__.'/auth.php';
