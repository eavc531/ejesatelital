<?php

Route::get('/logout', function (){
   Auth::logout();
   return redirect('/login');
});

Route::get('/', function (){
   return redirect('/home');
});


Route::group(['middleware' => 'auth'], function () {

         Route::get('invoice/{id}/occasional/details','invoiceController@invoiceOccasionalDetails')->name('invoiceOccasionalDetails');
         Route::get('invoice/{id}/pdf/download','invoiceController@invoicePdf')->name('invoicePdf');
         Route::get('invoice/{id}/confirm/payment','invoiceController@invoiceConfirmCustomerView')->name('invoiceConfirmCustomerView');

         Route::get('document/{id}/confirm','documentsController@confirmDocument')->name('confirmDocument');
         Route::get('customers/{id}/details','customersController@customerdetails')->name('customersDetails');

         Route::get('invoice/{id}/list','invoiceController@invoiceList')->name('invoiceList');
         Route::get('home', function () {
            return view('vendor.adminlte.home');
         })->name('home');
         Route::resource('documents','documentsController');
         Route::get('documents/{id}/list','documentsController@listDocuments')->name('listDocuments');

         Route::get('/download/{id}' , 'documentsController@download')->name('documentsDonwload');

         Route::get('excel/{id}/export' , 'documentsController@excelExport')->name('excelExport');
         Route::get('invoice/{id}/details','invoiceController@invoiceDetails')->name('invoiceDetails');
         Route::post('invoices/Confirm/Customer','invoiceController@invoiceConfirmCustomer')->name('invoiceConfirmCustomer');
         Route::get('customer/contact','mailController@contact')->name('contact');
         Route::post('customer/send/message','mailController@sendMessage')->name('sendMessage');

                  Route::group(['middleware' => 'Admin'], function () {

                     Route::get(   'invoice/cancel','invoiceController@cancelCreateInvoice')->name('cancelCreateInvoice');
                     Route::get(   'invoice/create/confirm','invoiceController@confirmCreateInvoice')->name('confirmCreateInvoice');
                     Route::post(    'invoice/add/detail/store','invoiceController@addDetailInvoiceStore')->name('addDetailInvoiceStore');
                     Route::get('invoice/{id}/add/detail','invoiceController@addDetailInvoice')->name('addDetailInvoice');
                     Route::get('invoice/detail/{id}/delete','invoiceController@deleteDF')->name('deleteDF');
                     Route::get('custoemr/{id}/invoice/preview','invoiceController@invoiceOccasionalPreview')->name('invoiceOccasionalPreview');
                     Route::post('customer/{id}/invoice/Occasional/store','invoiceController@invoiceOccasionalStore')->name('invoiceOccasionalStore');
                     Route::get('delete/{id}/service/Occasional','invoiceController@deleteAO')->name('deleteAO');
                     Route::post('customer/{id}/invoice/Occasional/Add','invoiceController@invoiceOccasionalAd')->name('invoiceOccasionalAd');

                     Route::get('customer/{id}/invoice/Occasional','invoiceController@invoiceOccasional')->name('invoiceOccasional');

                     Route::get('vehicle/{id}/delete','customersController@vehicleDestroy')->name('vehicleDestroy');
                     Route::post('device/Destroy','devicesController@deviceDestroy')->name('deviceDestroy');
                     Route::post('service/Vehicle/Destroy','servicesController@serviceVDestroy')->name('serviceVDestroy');
                     Route::resource('services','servicesController');
                     //AQUIWWWIIIIIIIIIIIIIII
                     Route::resource('users','UsersController');
                     Route::resource('mail','mailController');
                     Route::get('user/{id}/clients','UsersController@userClients')->name('userClients');
                     Route::get('user/{id}/assignCustomer','UsersController@assignCustomer')->name('assignCustomer');
                     Route::post('assign','UsersController@assign')->name('assign');
                     Route::get('customer/{id}/sms','customersController@sendSms')->name('sendSms');
                     Route::get('customers/{b}/enable','customersController@enableUser')->name('enableUser');
                     Route::get('customer/{id}/disabled','customersController@disabled')->name('disabled');
                     Route::get('servicesAd/{id}/delete','customersController@deleteSA')->name('deleteSA');

                     //Route::post('customers/list/disabled','customersController@index2')->name('index2');
                  });


                  Route::group(['middleware' => 'qualified'], function () {


                     Route::get('Verified/{note}/notification/{seller}/new/{client}/user','notificationsController@VerifiednotificationNewUser')->name('VerifiednotificationNewUser');
                     Route::get('Verified/{note}/notification/{seller}/new/{client}/document','notificationsController@VerifiednotificationNewDocu')->name('VerifiednotificationNewDocu');
                     Route::get('Verified/{note}/notification/{seller}/new/{client}/note','notificationsController@VerifiednotificationNewNote')->name('VerifiednotificationNewNote');

                     Route::get('Verified/notification/{note}','notificationsController@verifiednotification')->name('verifiednotification');
                     Route::get('notifications/viewed','notificationsController@notificationsViewed')->name('notificationsViewed');
                     Route::get('notifications','notificationsController@notifications')->name('notifications');
                     Route::get('customer/create','customersController@customerCreate')->name('customerCreate');
                     Route::resource('notes','notesController');
                     Route::get('notes/{id}/delete','notesController@notesDestroy')->name('notesDestroy');
                     Route::get('customer/{id}/notes','notesController@notesList')->name('notesList');
                     Route::get('customer/{id}/notes/create','notesController@notesCreate')->name('notesCreate');

                     Route::get('customers/{a}','customersController@customerDisabled')->name('customerDisabled');
                     Route::get('customer/{var}','customersController@Confirm')->name('confirm');
                     Route::get('client/{v}','customersController@Pending')->name('Pending');
                     Route::resource('customers','customersController');
                     //Route::get('custom/','customersController@create2')->name('create2');

                     //Route::post('customers/list/disabled','customersController@index2')->name('index2');
                     Route::get('clientSearch','customersController@customerSearch')->name('customerSearch');
                     Route::get('clientSearchName','customersController@clientSearchName')->name('clientSearchName');
                     Route::get('customers/{id}/mail','mailController@mailCustomer')->name('mailCustomer');
                     Route::post('customers/send/mail','mailController@sendMessageCustomer')->name('sendMessageCustomer');

            Route::get('customers/{id}/services','customersController@customerServices')->name('customersServices');
            Route::get('customers/{id}/vehicles','customersController@customersVehicles')->name('customersVehicles');
            Route::get('customers/{id}/create/vehicles','customersController@createVehicles')->name('createVehicles');
            Route::get('customers/{id}/additionalServices','customersController@additionalServices')->name('additionalServices');

            Route::post('customers/store/vehicles','customersController@storeVehicles')->name('storeVehicles');



            Route::resource('vehiclesServices','vehiclesServicesController');
            Route::get('vehicles/{id}/services','vehiclesServicesController@addService')->name('addService');
            //Route::get('vehicles/{id}/services2','vehiclesServicesController@addService2')->name('addService2');

            Route::post('customers/store/servicesAdd','customersController@additionalServicesStore')->name('additionalServicesStore');
            //SIN USO //SIN USO//SIN USO//SIN USO//SIN USO//SIN USO//SIN USO//SIN USO//SIN USO
            Route::post('invoice/send','invoiceController@invoiceSends')->name('invoiceSends');

            Route::post('invoice/create','invoiceController@invoiceCreate')->name('invoiceCreate');



            //Route::get('pdf/{$id}','pdfController')->name('pdf');
            Route::post('invoices/{id}/Confirm','invoiceController@invoicesConfirm')->name('invoicesConfirm');


            Route::resource('invoice','invoiceController');




            Route::resource('devices','devicesController');
            Route::get('devices/{id}/list','devicesController@devicesList')->name('devicesList');

            Route::get('vehicle/{id}/create/device','devicesController@deviceCreate')->name('deviceCreate');
            //Route::get('vehicle/{id}/change/device','devicesController@deviceChange')->name('deviceChange');

            //Route::post('vehicle/{id}/change/device/store','devicesController@deviceChangeStore')->name('deviceChangeStore');


            Route::get('document/{id}/delete','documentsController@documentDelete')->name('documentDelete');

            Route::get('document/{id}/refuse','documentsController@documentDelete2')->name('documentDelete2');

            Route::post('document/Destroy','documentsController@documentDestroy')->name('documentDestroy');



         });
});
