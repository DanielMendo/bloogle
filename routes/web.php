<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PaymentSuccessController;
use App\Http\Controllers\AccountSettingsController;
use Laravel\Cashier\Http\Controllers\WebhookController;
use App\Http\Controllers\Auth\PasswordResetLinkController;

// Ruta de webhook con Stripe
Route::post('/webhook', [WebhookController::class, 'handleWebhook']);

Route::get('/verified', [ProductController::class, 'show'])->name('product.show');
Route::middleware('auth')->group(function () {
    Route::get('checkout/{plan}', [CheckoutController::class, '__invoke'])->name('checkout');
    Route::get('/checkout/success/verified', PaymentSuccessController::class)->name('checkout.verified');
});

Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
Route::get('subscriptions/verified/{subscriptionId}', [SubscriptionController::class, 'show'])->name('subscription.show');
Route::delete('/subscription/cancel/{subscription}', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');

// Rutas de autenticación
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'store']);
Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

// Rutas de notificaciones
Route::get('/notifications', NotificationController::class)->name('notifications')->middleware('auth');

// Rutas de configuración de cuenta
Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [AccountSettingsController::class, 'index'])->name('view');
    Route::put('/emailUpdate/{user}', [AccountSettingsController::class, 'updateEmail'])->name('emailUpdate');
    Route::put('/updatePassword/{user}', [AccountSettingsController::class, 'updatePassword'])->name('updatePassword');
    Route::delete('/deleteAccount/{user}', [AccountSettingsController::class, 'deleteAccount'])->name('deleteAccount');
});

// Rutas de inicio
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Rutas de publicación
Route::get('{user:slug}/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::middleware('auth')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/create', [PostController::class, 'store'])->name('post.store');
    Route::get('post/edit/{post:slug}', [PostController::class, 'edit'])->name('post.edit');
    Route::put('post/update/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('post/delete/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    
});

// Rutas de categorías
Route::get('categories/{category:name}', [CategoryController::class, 'show'])->name('category.show');

// Rutas de perfil
Route::get('/{user:slug}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('profile/edit/{user:slug}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile/update/{user}', [ProfileController::class, 'update'])->name('profile.update');


// Rutas de seguidores
Route::post('/{user:slug}/follow', [FollowerController::class, 'store'])->name('user.follow');
Route::delete('/{user:slug}/destroy', [FollowerController::class, 'destroy'])->name('user.unfollow');

// Rutas de imagen
Route::post('/image', [ImageController::class, 'store'])->name('image.store');

require __DIR__.'/auth.php';
