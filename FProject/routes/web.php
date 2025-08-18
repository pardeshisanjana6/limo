<?php
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/index',[FrontendController::class,'index'])->name('home');
Route::get('/about',[FrontendController::class,'about'])->name('about');
Route::get('/layout',[FrontendController::class,'layout'])->name('layout');
Route::get('/cars',[FrontendController::class,'cars'])->name('cars');
Route::get('/blog',[FrontendController::class,'blog'])->name('blog');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact.show');
Route::post('/contact', [FrontendController::class, 'sendContactEmail'])->name('contact.send');
Route::get('/home',[FrontendController::class,'home'])->name('home2');
Route::get('/userlayout',[UserController::class,'userlayout'])->name('userlayout');

Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.post');
    Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/booking', [FrontendController::class, 'myBookings'])->name('my.bookings');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->group(function () { 

    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login'); 
        Route::post('/login', [AdminController::class, 'login'])->name('login.post'); 
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard'); 
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout'); 

        Route::get('admin/contact-queries', [AdminController::class, 'manageContactQueries'])->name('admin.contact');

        Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
        Route::delete('vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

        Route::get('/bookings', [AdminController::class, 'bookingsIndex'])->name('bookings.index');
        Route::get('/bookings/{booking}', [AdminController::class, 'bookingsShow'])->name('bookings.show');
        Route::put('/bookings/{booking}/status', [AdminController::class, 'bookingsUpdateStatus'])->name('bookings.updateStatus');
        Route::put('/bookings/{booking}', [AdminController::class, 'update'])->name('bookings.update');
        Route::post('/bookings/{booking}/cancel', [AdminController::class, 'cancelBooking'])->name('bookings.cancel');

        Route::get('/brands', [VehicleController::class, 'brandsIndex'])->name('brands.index');
        Route::get('/brands/{brand}/vehicles', [VehicleController::class, 'vehiclesByBrand'])->name('brands.vehicles');
        Route::delete('/brands/{brand}', [VehicleController::class, 'destroyBrand'])->name('brands.destroy'); 
        Route::post('/brands', [VehicleController::class, 'storeBrand'])->name('brands.store');
        

        Route::get('/users', [UserController::class, 'index'])->name('users.index'); 
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

        Route::patch('/bookings/{booking}/confirm', [AdminController::class, 'confirm'])->name('bookings.confirm'); 

        Route::put('/bookings/{booking}/status', [AdminController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::post('/contact-queries/{query}/reply', [AdminController::class, 'replyToQuery'])->name('contact.reply');
        Route::post('/bookings/{booking}/cancel', [AdminController::class, 'cancelBooking'])->name('bookings.cancel');

        Route::get('/payments', [PaymentController::class, 'adminIndex'])->name('admin.payments');
    });

});

Route::middleware(['auth'])->group(function (){ 
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'showVehicleDetails'])->name('vehicle.details');
    Route::get('/vehicles/{vehicle}/book', [VehicleController::class, 'showBookingForm'])->name('booking.form');
    Route::post('/vehicles/{vehicle}/confirm-booking', [VehicleController::class, 'storeBooking'])->name('booking.store');
});
    Route::get('vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('admin.vehicles.edit');
    Route::put('vehicles/{vehicle}', [VehicleController::class, 'updateVehicle'])->name('admin.vehicles.update');

Route::get('/users-home', function () {
    return '<h1>Welcome to the General Users Page!</h1>'; 
})->name('users.index');

Route::post('/api/check-availability', [FrontendController::class, 'checkAvailability'])->name('api.checkAvailability');


Route::get('razorpay-payment/{booking}', [PaymentController::class, 'index'])->name('users.payment');
Route::post('razorpay-callback', [PaymentController::class, 'payment'])->name('payment.success');

Route::get('/bookings/{booking}/cancel', [AdminController::class, 'cancelBooking'])->name('bookings.cancel');
Route::post('/admin/bookings/{booking}/refund', [AdminController::class, 'processRefund'])->name('admin.bookings.refund');
Route::post('/bookings/{booking}/reconfirm', [BookingController::class, 'confirmBooking'])->name('bookings.reconfirm');

// Auth::routes();