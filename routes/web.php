<?php

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


Route::get('/','FrontendController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'],function(){
	 Route::prefix('users')->group(function(){
  Route::get('/view','UserController@view')->name('users.view');
  Route::get('/add','UserController@addUser')->name('users.add');
  Route::post('/store','UserController@store')->name('users.store');
  Route::get('/edit/{id}','UserController@edit')->name('users.edit');
  Route::post('/update/{id}','UserController@update')->name('users.update');
  Route::get('/delete/{id}','UserController@delete')->name('users.delete');

});

Route::prefix('profiles')->group(function(){
  Route::get('/view','ProfileController@view')->name('profiles.view');
  Route::get('/edit','ProfileController@edit')->name('profiles.edit');
  Route::post('/store','ProfileController@update')->name('profiles.update');
  

});
 Route::prefix('suppliers')->group(function(){
  Route::get('/view','SupplierController@view')->name('suppliers.view');
  Route::get('/add','SupplierController@add')->name('suppliers.add');
  Route::post('/store','SupplierController@store')->name('suppliers.store');
  Route::get('/edit/{id}','SupplierController@edit')->name('suppliers.edit');
  Route::post('/update/{id}','SupplierController@update')->name('suppliers.update');
  Route::get('/delete/{id}','SupplierController@delete')->name('suppliers.delete');

});

  Route::prefix('customers')->group(function(){
  Route::get('/view','CustomerController@view')->name('customers.view');
  Route::get('/add','CustomerController@add')->name('customers.add');
  Route::post('/store','CustomerController@store')->name('customers.store');
  Route::get('/edit/{id}','CustomerController@edit')->name('customers.edit');
  Route::post('/update/{id}','CustomerController@update')->name('customers.update');
  Route::get('/delete/{id}','CustomerController@delete')->name('customers.delete');
  Route::get('/credit','CustomerController@creditCustomer')->name('customers.credit');
  Route::get('/credit/pdf','CustomerController@creditCustomerPdf')->name('customers.credit.pdf');
  Route::get('/invoice/edit/{invoice_id}','CustomerController@editInvoice')->name('customers.edit.invoice');
   Route::post('/invoice/update/{invoice_id}','CustomerController@updateInvoice')->name('customers.update.invoice');
   Route::get('/invoice/details/{invoice_id}','CustomerController@invoiceDetailsPdf')->name('customers.invoice.details.pdf');

});
  Route::prefix('units')->group(function(){
  Route::get('/view','UnitController@view')->name('units.view');
  Route::get('/add','UnitController@add')->name('units.add');
  Route::post('/store','UnitController@store')->name('units.store');
  Route::get('/edit/{id}','UnitController@edit')->name('units.edit');
  Route::post('/update/{id}','UnitController@update')->name('units.update');
  Route::get('/delete/{id}','UnitController@delete')->name('units.delete');

});
  Route::prefix('categories')->group(function(){
  Route::get('/view','CategoryController@view')->name('categories.view');
  Route::get('/add','CategoryController@add')->name('categories.add');
  Route::post('/store','CategoryController@store')->name('categories.store');
  Route::get('/edit/{id}','CategoryController@edit')->name('categories.edit');
  Route::post('/update/{id}','CategoryController@update')->name('categories.update');
  Route::get('/delete/{id}','CategoryController@delete')->name('categories.delete');

});
  Route::prefix('products')->group(function(){
  Route::get('/view','ProductController@view')->name('products.view');
  Route::get('/add','ProductController@add')->name('products.add');
  Route::post('/store','ProductController@store')->name('products.store');
  Route::get('/edit/{id}','ProductController@edit')->name('products.edit');
  Route::post('/update/{id}','ProductController@update')->name('products.update');
  Route::get('/delete/{id}','ProductController@delete')->name('products.delete');


});
  Route::prefix('purchase')->group(function(){
  Route::get('/view','PurchaseController@view')->name('purchase.view');
  Route::get('/add','PurchaseController@add')->name('purchase.add');
  Route::post('/store','PurchaseController@store')->name('purchase.store');
  Route::get('/pending','PurchaseController@pending')->name('purchase.pending');
  Route::get('/approve/{id}','PurchaseController@approve')->name('purchase.approve');
  Route::get('/delete/{id}','PurchaseController@delete')->name('purchase.delete');
  Route::get('/report','PurchaseController@purchaseReport')->name('purchase.report');
   Route::get('/daily/report/pdf','PurchaseController@purchaseReportPdf')->name('daily.purchase.pdf');

});
  Route::get('/get-category','DefaultController@getCategory')->name('get-category');
  Route::get('/get-product','DefaultController@getProduct')->name('get-product');
   Route::get('/get-stock','DefaultController@getStock')->name('check-product-stock');

  Route::prefix('invoice')->group(function(){
  Route::get('/view','InvoiceController@view')->name('invoice.view');
  Route::get('/add','InvoiceController@add')->name('invoice.add');
  Route::post('/store','InvoiceController@store')->name('invoice.store');
  Route::get('/pending','InvoiceController@pending')->name('invoice.pending');
  Route::get('/approve/{id}','InvoiceController@approve')->name('invoice.approve');
  Route::get('/delete/{id}','InvoiceController@delete')->name('invoice.delete');
  Route::post('/approve/store/{id}','InvoiceController@approvalStore')->name('approve.store');
  Route::get('/print/list','InvoiceController@printInvoiceList')->name('invoice.print.list');
  Route::get('/print/{id}','InvoiceController@printInvoice')->name('invoice.print');
  Route::get('/daily/report','InvoiceController@invoiceReport')->name('invoice.daily.report');
  Route::get('/daily/report/pdf','InvoiceController@invoiceReportPdf')->name('daily.invoice.pdf');
 

});

  Route::prefix('stock')->group(function(){
  Route::get('/report','StockController@stockReport')->name('stock.report');
  Route::get('/report/pdf','StockController@stockReportPdf')->name('stock.report.pdf');
  Route::get('/report/supplier/product/wise','StockController@supplierProductWise')->name('stock.report.supplier.product.wise');
   Route::get('/report/supplier/wise/pdf','StockController@supplierWisePdf')->name('stock.report.supplier.wise.pdf');
   Route::get('/report/product/wise/pdf','StockController@productWisePdf')->name('stock.report.product.wise.pdf');
  
 

});


});



