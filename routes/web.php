<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (view()->exists('welcome')) {
        return view('welcome');
    }

    return redirect()->route('blog.index');
})->name('home');

// Публічні маршрути
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
    'services' => 'appointment',
]);



// Захищені маршрути (лише для автентифікованих користувачів)
Route::middleware('auth')->group(function () {
    Route::get('/blog/admin', [BlogController::class, 'admin'])->name('blog.admin');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/blog/{blog}/works', [BlogController::class, 'worksEdit'])->name('blog.works');
    Route::post('/blog/{blog}/works', [BlogController::class, 'worksStore'])->name('blog.works.store');
    Route::resource('blog', BlogController::class)->except(['index', 'show']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');

Route::view('/dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/auth.php';
