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

Route::get('select-regency','Owner\KamarController@selectRegency'); // Select Regency
Route::get('select-district','Owner\KamarController@selectDistrict'); // Select District

Auth::routes();

///// FRONTEND \\\\\
// Homepage

Route::get('/','Frontend\FrontendsController@homepage'); // homepage
Route::get('/room/{slug}','Frontend\FrontendsController@showkamar'); //Show Kamar
Route::get('show-all-room','Frontend\FrontendsController@showAllKamar'); //Show all kamar
Route::get('filter-kamar','Frontend\FrontendsController@filterKamar'); //Filter kamar
Route::get('kost','Frontend\FrontendsController@showByKota'); // show kamar by kota

Route::get('simpan/kamar','Frontend\FrontendsController@simpanKamar'); // proses simpan kamar (favorite)
Route::get('hapus/kamar','Frontend\FrontendsController@hapusKamar'); // proses hapus kamar (favorite)

Route::middleware('auth')->group(function () {
  Route::get('/home', 'HomeController@index');

  ////// PEMILIK \\\\\\
  Route::prefix('/pemilik')->middleware('role:Pemilik')->group(function () {

    Route::resource('kamar','Owner\KamarController'); //Data Kamar

    Route::post('rekening','Owner\BankController@rekening'); // Rekening
    Route::get('rekening/{id}','Owner\BankController@rekeningEdit'); // Rekening Edit
    Route::get('rekening/update','Owner\BankController@rekeningUpdate'); // Rekening Update
    Route::post('testimoni','Owner\ProfileController@testimoni');

    Route::get('booking-list','Owner\BookListController@index')->name('booking-list'); // Booking List
    Route::get('room/{key}','Owner\BookListController@confirm_payment'); // Confirm payment from user
    Route::put('payment-confirm/{key}','Owner\BookListController@proses_confirm_payment'); // Proses Confirm Payment
    Route::get('reject-payment','Owner\BookListController@reject_confirm_payment'); // Reject Payment
    Route::get('penghuni','Owner\PenghuniController@penghuni'); // Penghuni
  });


  ///// USER \\\\\
  Route::prefix('/user')->middleware('role:Pencari')->group(function () {
    Route::post('/transaction-room/{id}','User\TransactionController@store')->name('sewa.store'); // Proses save Room
    Route::get('room/{key}','User\TransactionController@detail_payment'); // Detail payment
    Route::put('konfirmasi-payment/{id}','User\TransactionController@update'); // Konfirmasi Payment
    Route::get('tagihan','User\TransactionController@tagihan'); // Ambil data tagihan
    Route::get('myroom','User\MyRoomsController@myroom'); // Kamar aktif
  });

  ////// GLOBAL ROUTE \\\\\\
  Route::get('profile','GlobalController@profile');
  Route::put('profile/{id}','GlobalController@profileUpdate');
});

