<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\productController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
});



// Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('users.')->group(function () {

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::get('/admin/login',[AdminController::class, 'AdminLogin'])->name('admin.login');
Route::post('/admin/login_submit',[AdminController::class, 'AdminLoginSubmit'])->name('admin.login_submit');
Route::get('/admin/logout',[AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/forget_password',[AdminController::class, 'AdminForgetPssowrd'])->name('admin.forget_Password');
Route::post('/admin/password_submit',[AdminController::class, 'AdminPasswordSubmit'])->name('admin.password_submit');
Route::get('/admin/reset-password/{token}/{email}',[AdminController::class, 'AdminResetPassword']);
Route::post('/admin/reset-password-submit',[AdminController::class, 'AdminResetPasswordSubmit'])->name('admin.reset_password_submit');



//  Admin Route
Route::middleware('admin')->group(function(){

    Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])->name('admin.Dashboard');
    Route::get('/admin/profile',[AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile_store',[AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change-profile',[AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password-update',[AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');






   // Product Routes
Route::get('/admin/product-create',[productController::class, 'CreateProduct'])->name('admin.product.create');
Route::post('/admin/poduct-create-Store',[productController::class, 'CreateProductStore'])->name('admin.product.store');
Route::get('/admin/product-edit/{id}',[productController::class, 'ProductEdit'])->name('admin.product.edit');
Route::post('/admin/product-update/{id}',[productController::class, 'ProductUpdate'])->name('admin.product.update');
Route::get('/admin/product-delete/{id}',[productController::class, 'ProductDelete'])->name('admin.product.delete');
Route::post('/admin/poduct-create-add',[productController::class, 'CreateProductAdd'])->name('admin.product.add');



    // Category Routs
Route::get('/admin/Category',[CategoryController::class, 'ShowCategory'])->name('admin.category.show');
Route::post('/admin/create-actegory',[CategoryController::class, 'CreateCategory'])->name('admin.category.create');
Route::get('/admin/category-edit/{id}',[CategoryController::class, 'CategorytEdit'])->name('admin.category.edit');
Route::get('/admin/category-delete/{id}',[CategoryController::class, 'CategoryDelete'])->name('admin.category.delete');



    // Customer Route
Route::get('/admin/customer',[CustomerController::class, 'ShowCustomer'])->name('admin.customer.index');
Route::get('/admin/create-customer',[CustomerController::class, 'CreateCustomer'])->name('admin.customer.create');
Route::post('/admin/Customer-Store',[CustomerController::class, 'CustomerStore'])->name('admin.customer.store');
Route::get('/admin/customer-edit/{id}',[CustomerController::class, 'CustomertEdit'])->name('admin.customer.edit');
Route::post('/admin/custmer-update/{id}',[CustomerController::class, 'CustomerUpdate'])->name('admin.customer.update');
Route::get('/admin/customer-delete/{id}',[CustomerController::class, 'CustomerDelete'])->name('admin.customer.delete');



    // Order Route
Route::get('/admin/customer/order-index',[OrderController::class, 'Indexorder'])->name('admin.customer.order.index');






//Order Details
Route::get('/admin/customer/OrderDetails/{id}', [OrderDetailsController::class, 'ShowOrder'])->name('admin.customer.order.details');
Route::get('/admin/customer/orders-show/{id}', [OrderDetailsController::class, 'CustomerOrderShow'])->name('admin.customer.orders.show');
Route::post('orders/{order}/update-status', [OrderController::class, 'updatePaymentStatus'])->name('admin.customer.order.update');
Route::put('/admin/orders/{id}/update-status', [OrderDetailsController::class, 'updateStatus'])->name('admin.orders.updateStatus');
Route::get('/admin/customer/order-edit/{id}',[OrderController::class, 'EditOrder'])->name('admin.customer.order.edit');
// Route::post('/admin/customer/order-update/{id}',[OrderController::class, 'UpdateOrder'])->name('admin.customer.order.update');
Route::get('/admin/customer/order-delete/{id}',[OrderController::class, 'OrderDelete'])->name('admin.customer.order.delete');





//Report Route
Route::get('/admin/report',[ReportController::class, 'SalesReport'])->name('admin.report');
Route::get('/admin/report-services',[ReportController::class, 'ServicesReport'])->name('admin.report.services');




//Service Route
Route::get('/admin/Services',[ServicesController::class, 'index'])->name('admin.services.index');
Route::get('/admin/create-services',[ServicesController::class, 'CreateServices'])->name('admin.create.service');
Route::post('/admin/servics-store',[ServicesController::class, 'StoreService'])->name('admin.service.store');
Route::get('/admin/service-details/{id}',[ServicesController::class, 'serviceDetails'])->name('admin.service.details');




// Supplier Route
Route::get('/admin/suppliers',[SupplierController::class, 'index'])->name('admin.supplier.index');
Route::get('/admin/create-supplier',[SupplierController::class, 'create'])->name('admin.supplier.create');
Route::post('/admin/store-supplier',[SupplierController::class, 'StoreSupplier'])->name('admin.supplier.store');
Route::get('/admin/supplier-details/{id}',[SupplierController::class, 'SupplierDetails'])->name('admin.supplier.details');
Route::get('/admin/supplier-delete/{id}',[SupplierController::class, 'SupplierDelete'])->name('admin.supplier.delete');


});




// Order Route
Route::get('order/create', [OrderController::class, 'CreateOrder'])->name('admin.order.create');
Route::get('/customer/{customer}/order/create',[OrderController::class, 'CreateOrder'])->name('admin.customer.order.create');
Route::post('/Order-Store',[OrderController::class, 'StoreOrder'])->name('admin.order.store');

// Product Route
Route::get('/product',[productController::class, 'ProductIndex'])->name('admin.product.index');
Route::get('order/create', [OrderController::class, 'CreateOrder'])->name('admin.order.create');





// CLients Route
Route::middleware('client')->group(function(){

    Route::get('/client/dashboard',[ClientController::class, 'ClientDashboard'])->name('client.Dashboard');
    Route::get('/client/profile',[ClientController::class, 'ClientProfile'])->name('client.profile');
    Route::post('/client/profile-store',[ClientController::class, 'ClientProfileStore'])->name('client.profile.store');
    Route::get('/client/change_password',[ClientController::class, 'ClinetChangePassword'])->name('client.Change_password');
    Route::post('/client/update_password_submit',[ClientController::class, 'ClientUpdatePasswordSubmit'])->name('client.password.update-submit');


});

Route::get('/client/login',[ClientController::class, 'ClientLogin'])->name('client.login');
Route::get('/client/register',[ClientController::class, 'ClientRegister'])->name('client.register');
Route::post('/client/register_submit',[ClientController::class, 'ClientRegisterSubmit'])->name('client.register_submit');
Route::post('/client/login-submit',[ClientController::class, 'ClientLoginSubmit'])->name('client.client_submit');
Route::get('/client/logout',[ClientController::class, 'ClientLogout'])->name('client.logout');



Route::get('/index',[AdminController::class, 'index']);


require __DIR__.'/auth.php';
