<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\BarberController;
use App\Http\Controllers\BarberAppointmentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

// Main routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Authentication routes
require __DIR__.'/auth.php';

// Search routes
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');

// Recommendation routes
Route::get('/recommendations/top-rated', [RecommendationController::class, 'topRated'])->name('recommendation.top_rated');
Route::get('/recommendations/for-me', [RecommendationController::class, 'forUser'])->middleware('auth')->name('recommendation.for_user');

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    // Barber routes - Specific routes first
    Route::get('/barber/create', [BarberController::class, 'create'])->name('barber.create');
    Route::post('/barber', [BarberController::class, 'store'])->name('barber.store');

    // Appointment routes
    Route::get('/appointment/create/{barber}', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment/{barber}', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/appointment/{appointment}', [AppointmentController::class, 'show'])->name('appointment.show');
    Route::patch('/appointment/{appointment}/status', [AppointmentController::class, 'updateStatus'])->name('appointment.update.status');

    // Barber Dashboard routes
    Route::get('/barber/dashboard', function () {
        $user = auth()->user();
        $barber = $user->barber;
        $appointments = \App\Models\Appointment::where('barber_id', $barber->id)
            ->orderBy('appointment_time', 'asc')
            ->get();
        return view('barber.dashboard', compact('appointments'));
    })->name('barber.dashboard');

    // Barber appointment management routes
    Route::prefix('barbers')->name('barbers.')->group(function () {
        Route::get('/appointments', [BarberAppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/appointments/{appointment}', [BarberAppointmentController::class, 'show'])->name('appointments.show');
        Route::put('/appointments/{appointment}', [BarberAppointmentController::class, 'update'])->name('appointments.update');
        Route::post('/appointments/{appointment}/confirm', [BarberAppointmentController::class, 'confirm'])->name('appointments.confirm');
    });

    // Availability routes
    Route::get('/availability/create/{barber}', [AvailabilityController::class, 'create'])->name('availability.create');
    Route::post('/availability/{barber}', [AvailabilityController::class, 'store'])->name('availability.store');
    Route::get('/availability/{barber}', [AvailabilityController::class, 'index'])->name('availability.index');

    // Photo routes
    Route::get('/photo/create/{barber}', [PhotoController::class, 'create'])->name('photo.create');
    Route::post('/photo/{barber}', [PhotoController::class, 'store'])->name('photo.store');
    Route::post('/photo/update/profile/{barber}', [PhotoController::class, 'updateProfileImage'])->name('photo.update.profile');

    // Favorite routes
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/favorite/{barber}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{barber}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');

    // Review routes
    Route::get('/review/create/{barber}', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/review/{barber}', [ReviewController::class, 'store'])->name('review.store');
    Route::get('/review/{barber}', [ReviewController::class, 'index'])->name('review.index');

    // Message routes
    Route::get('/messages', [MessageController::class, 'index'])->name('message.index');
    Route::get('/messages/{userId}', [MessageController::class, 'show'])->name('message.show');
    Route::post('/messages', [MessageController::class, 'store'])->name('message.store');

    // Notification routes
    Route::get('/notifications', function () {
        return view('notification.index');
    })->name('notification.index');
    Route::post('/notifications/{id}/markAsRead', function ($id) {
        auth()->user()->notifications()->findOrFail($id)->markAsRead();
        return back();
    })->name('notification.markAsRead');

    // Payment routes
    Route::get('/payment/checkout/{appointmentId}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success/{appointmentId}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('/payment/cancel/{appointmentId}', [PaymentController::class, 'cancel'])->name('payment.cancel');
});

// Barber profile route - Moved after the specific routes
Route::get('/barber/{barber}', function (\App\Models\Barber $barber) {
    return view('barber.profile', compact('barber'));
})->name('barber.profile');

// Admin routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/barbers', [AdminController::class, 'barbers'])->name('barbers');
    Route::get('/appointments', [AdminController::class, 'appointments'])->name('appointments');
    Route::post('/users/{userId}/toggleAdmin', [AdminController::class, 'toggleAdmin'])->name('toggleAdmin');
});
