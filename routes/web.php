<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; //Contorller untuk home user
use App\Http\Controllers\AdminController; //controller untuk admin
use App\Http\Controllers\CheckoutController; //controller untuk login
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('frontend.home.home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Tambahkan rute ini
Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth','verified');
Route::middleware(['auth'])->group(function () {
    Route::get('/user_order', [OrderController::class, 'index'])->name('order.index');
});
// Route untuk halaman publik
Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product_search', [HomeController::class, 'product_search']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/detail', [HomeController::class, 'detail']);
Route::get('/view_categories', [AdminController::class, 'view_categories']);
Route::post('/add_categories', [AdminController::class, 'add_categories']);
Route::get('/delete_categories/{id}', [AdminController::class, 'delete_categories']);
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/show_product', [AdminController::class, 'show_product']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('/update_product/{id}', [AdminController::class, 'update_product']);
Route::get('/order', [AdminController::class, 'order']);
Route::put('/update-order/{id}', [AdminController::class, 'updateOrder'])->name('update.order');
Route::put('/update-order-status/{id}', [AdminController::class, 'updateOrderStatus']);


Route::get('/search', [AdminController::class, 'searchdata']);


Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);
Route::get('/show_cart', [HomeController::class, 'show_cart']);

Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('cart.delete');

Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processPayment'])->name('checkout');
Route::get('/order-details', [OrderController::class, 'showDetails'])->name('order.details');
Route::post('/update-order', [OrderController::class, 'updateOrder'])->name('order.update');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'storeOrder'])->name('order.store');
Route::post('/checkout', [CheckoutController::class, 'processPayment'])->name('checkout');
Route::post('/confirm_payment', [OrderController::class, 'add_order']);
Route::get('/print-order/{id}', [OrderController::class, 'printOrder'])->name('order.print');
Route::post('/submit-review', [OrderController::class, 'submitReview'])->name('review.submit');