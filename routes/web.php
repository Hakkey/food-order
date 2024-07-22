<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\MainPageController::class, 'index'])->name('mainpage.index');
// add route add to the cart using the CartController
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.add');
Route::delete('/cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');
Route::post('/cart/save-for-later/{id}', [App\Http\Controllers\CartController::class, 'saveForLater'])->name('cart.saveForLater');

// Add route for page order
Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');
Route::get('order/payment/{id}', [App\Http\Controllers\OrderController::class, 'payment'])->name('order.payment');
Route::get('order/receipt/{id}', [App\Http\Controllers\OrderController::class, 'receipt'])->name('order.receipt');
// Route for saving template
Route::post('order/save-template', [App\Http\Controllers\OrderController::class, 'saveTemplate'])->name('order.save-template');
// Route for saving order
Route::post('order/save', [App\Http\Controllers\OrderController::class, 'save'])->name('order.save');
// Route for loading page
Route::get('order/loading/{id}', [App\Http\Controllers\OrderController::class, 'loading'])->name('order.loading');

// route to check order status
Route::get('check-order-status', [App\Http\Controllers\OrderController::class, 'status'])->name('order.status');

// route to check template by using phone number
Route::get('check-template', [App\Http\Controllers\OrderController::class, 'checkTemplate'])->name('order.check-template');

// route to order template
Route::post('order/order-template', [App\Http\Controllers\OrderController::class, 'orderTemplate'])->name('order.order-template');



// Route::delete('/save-for-later/{id}', [App\Http\Controllers\SaveForLaterController::class, 'destroy'])->name('saveForLater.destroy');

Auth::routes();


// add group route to access the admin page using the AdminController


// add group route to access the menus page using the MenuController
Route::group(['middleware' => ['auth', Admin::class], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // add group of routes for the menus page using the MenuController for CRUD operations
    Route::resource('menus', App\Http\Controllers\MenuController::class)->names([
        'index' => 'menus.index',
        'create' => 'menus.create',
        'store' => 'menus.store',
        'show' => 'menus.show',
        'edit' => 'menus.edit',
        'update' => 'menus.update',
        'destroy' => 'menus.destroy',
    ]);
    Route::get('menus/datatable', [App\Http\Controllers\MenuController::class, 'datatable'])->name('menus.datatable');

    // orders page
    Route::get('orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders.index');
    // all completed orders
    Route::get('orders/completed', [App\Http\Controllers\HomeController::class, 'completed'])->name('orders.completed');
    // all orders
    Route::get('orders/all', [App\Http\Controllers\HomeController::class, 'allOrders'])->name('orders.all');

    // update order status
    Route::post('orders/update-status', [App\Http\Controllers\OrderController::class, 'updateStatus'])->name('orders.update-status');

});

// add middleware for staff
// Route::group(['middleware' => ['auth', 'staff'], 'prefix' => 'staff'], function () {
//     // Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('staff.dashboard');
//     Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('staff.orders');
//     Route::get('/orders/completed', [App\Http\Controllers\HomeController::class, 'completed'])->name('staff.completed');
// });

