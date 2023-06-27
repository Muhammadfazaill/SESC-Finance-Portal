<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment-portal', [InvoiceController::class, 'index'])->name('invoices.index');
Route::post('/payment-portal/find', [InvoiceController::class, 'find'])->name('invoices.find');
Route::get('/payment-portal/show/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::put('/payment-portal/{invoice}/pay', [InvoiceController::class, 'pay'])->name('invoices.pay');
Route::post('/invoices/createcourse', [InvoiceController::class, 'createcourse'])->name('invoices.createcourse');
Route::post('/invoices/createlibraryinvoice', [InvoiceController::class, 'createlibraryinvoice'])->name('invoices.createcoursecreatelibraryinvoice');
Route::post('/invoices/createstudent', [InvoiceController::class, 'createstudent'])->name('invoices.createstudent');
Route::post('/payment-portal/outstanding', [InvoiceController::class, 'getOutstandingInvoices'])->name('invoices.getOutstandingInvoices');