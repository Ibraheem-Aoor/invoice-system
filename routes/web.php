<?php

use App\Events\NewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserManagement\RoleController;
use App\Http\Controllers\UserManagement\UserController;
use App\User;
use App\Http\Controllers\Reports\ClientsReports;
use App\Notifications\NewUser as NotificationsNewUser;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

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

Route::get('/index', 'HomeController@index');
Route::get('/', 'HomeController@login');
Auth::routes();

        /*
        -Start Invoices Routes:
         *invoice CRUD operations.
         *Invoice Details  && invoice attachments.
        */
        // Route::get('/home', 'HomeController@index')->name('home');


        /* Sptie Package Routes */
        Route::group(['middleware' => ['auth']], function() {
            Route::resource('roles','UserManagement\RoleController');
            Route::resource('users','UserManagement\UserController');
            });
        /* Sptie Package Routes */

        Route::namespace('invoices')->group(function()
        {
            Route::get('/invoices-list', 'InvoicesController@index');
            Route::get('/invoices-add', 'InvoicesController@show')->name('invoice.add');
            Route::post('/invoices-add', 'InvoicesController@store')->name('invoices.store');
            Route::get('/invoices-edit/{id}', 'InvoicesController@edit')->name('invoices.edit');
            Route::post('/invoices-update/{id}', 'InvoicesController@update')->name('invoice.update');
            Route::get('/invoices-delete/{id}', 'InvoicesController@destroy')->name('invoice.delete');
            Route::get('/section/{id}', 'InvoicesController@getproducts'); //Ajax Request
            Route::get('/invoice-detailes/{id}', 'InvocieDetailes@index')->name('invoices.detailes.show');
            Route::get('View_file/{invoice_number}/{file_name}' , 'InvoiceAttachments@openFile')->name('file.sohw');
            Route::get('download/{invoice_number}/{file_name}' , 'InvoiceAttachments@openFile')->name('file.download');
            Route::post('delete/attachment_id' , 'InvoiceAttachments@delete')->name('attachment.delete');
            Route::post('add_attachment' , 'InvoiceAttachments@store')->name('attachment.store');
            Route::get('/invoices-archived' , 'InvoicesArchive@index');
            Route::get('/archive-invoice/{id}' , 'InvoicesArchive@invoiceArchive')->name('invoice.archive');
            Route::get('/archived-invoice-restore/{id}' , 'InvoicesArchive@InvoiceRestore')->name('invoices.archived.restore');
            Route::get('payment-status/{id}' , 'InvocieDetailes@payment')->name('invoice.payment.change');
            Route::get('/print-invoice/{id}' ,'InvocieDetailes@print')->name('invoice.print');
            Route::get('/invoices-not-paid' , 'InvocieDetailes@InvoicesNotPaid');
            Route::get('/invoices-fully-paid' , 'InvocieDetailes@InvoicestFullyPaid');
            Route::get('/invoices-Excel' , 'InvocieDetailes@getExcel')->name('invoice.getExcel');
        });
        /* End Invoices Routes */

        /* Start Reports Routes */
        Route::namespace('Reports')->group(function()
        {
            Route::get('invoices-reoprts' , 'InvoicesReports@index')->name('invoices.reports');
            Route::post('invoices-search' , 'InvoicesReports@search')->name('invoice.search');
            Route::get('cleints-reoprts' , 'ClientsReports@index')->name('clients.reports');
            Route::post('clients-search' , 'ClientsReports@search')->name('cleints.search');


        });
        /* End Reports Routes */

    /* Start Sections Routes */
    Route::namespace('Sections')->group(function()
    {
        Route::get('/sections' , 'SectionController@index');
        Route::post('/section/store',   'SectionController@store')->name('section.store');
        Route::patch('/section/update',   'SectionController@update')->name('section.update');
        Route::delete('/section/delete',   'SectionController@destroy')->name('section.delete');


    });
    /* End Sections Routes */

    /* Start Products Rotues */
    Route::namespace('Product')->group(function()
    {
        Route::get('/products' , 'ProductController@index');
        Route::post('/product/store',   'ProductController@store')->name('product.store');
        Route::patch('/product/update',   'ProductController@update')->name('product.update');
        Route::delete('/product/delete',   'ProductController@destroy')->name('product.delete');
    });
    /* End Products Rotues */

    Route::namespace('UserManagement')->group(function()
    {
        Route::get('account-disable/{id}','UserController@disableAccount')->name('account.disable');
        Route::get('account.active/{id}','UserController@activateAccount')->name('account.active');
    });

    /* Start Notifications Rotues */
    Route::namespace('Notifications')->group(function()
    {
        Route::get('mark-all/{flag?}' , 'NotificationsController@markAllasRead')->name('markAllasRead');
    });
    /* Start Notifications Rotues */

    // Testing real notifications
    Route::get('test' , function()
        {
            return now();
        });
        Route::get('/{page}', 'Admin\AdminController@index');



