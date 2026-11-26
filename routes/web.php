<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (view()->exists('welcome')) {
        return view('welcome');
    }

    return redirect()->route('blog.index');
})->name('home');

Route::get('/stats', [StatsController::class, 'pages'])->name('stats.pages');
Route::get('/stats/detail', [StatsController::class, 'detail'])->name('stats.detail');
Route::get('/stats/services', [StatsController::class, 'serviceStats'])->name('stats.services');

Route::resource('country', CountryController::class);

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::resource('services', AppointmentController::class)->names([
    'index' => 'services.index',
    'store' => 'services.store',
])->parameters([
    'services' => 'appointment'
]);

Route::get('/blog/{blog}/works', [BlogController::class, 'worksEdit'])
    ->name('blog.works');
Route::post('/blog/{blog}/works', [BlogController::class, 'worksStore'])
    ->name('blog.works.store');

// Маршруты блогу (окремий шлях /blog/admin має бути ПЕРЕД resource)
Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');
Route::resource('blog', BlogController::class);
