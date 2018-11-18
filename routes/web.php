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

Route::get('/', function () {
  return view('welcome');
  
});

  //filter
  Route::get('admin/payroll', 'PayrollController@index');
  Route::get('tahun/get/{id}', 'PayrollController@getTahun');
  Route::group(['prefix' => 'admin'], function () {

  //home karyawan tetap
  Route::get('/', 'ImportController@getImport')->name('import');
  Route::post('/import_parse','ImportController@parseImport')->name('import_parse');
  Route::post('/import_process','ImportController@processImport')->name('import_process');
  
  //payroll karyawan tetap
  Route::get('/', 'PayrollController@getImport')->name('importPayroll');
  Route::post('/import_parsePayroll','PayrollController@parseImport')->name('import_parsePayroll');
  Route::post('/import_processPayroll','PayrollController@processImport')->name('import_processPayroll');
  Route::post('/payroll','PayrollController@index')->name('payroll');

  //email karyawan tetap
  Route::post('/sendEmail','Email@sendEmail')->name('sendEmail');
  //Route::post('/sendEmail', 'Email@sendEmail')->name('sendEmail');
  Route::get('/sendEmail', 'Email@showEmail')->name('showEmail');
  //Route::get('admin/{slug}','Email@showEmail')->name('showEmail');

  //home karyawan kontrak
  Route::get('/kontrakHome','KontrakHomeController@index');
  
  //payroll karyawan kontrak
  Route::get('/kontrakPayroll','KontrakPayrollController@index');

  //email karyawan kontrak
  Route::get('/kontrakSendEmail','KontrakSendEmailController@index');

  
  //login
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');

  //register
  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  //forgot password
  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

});

Route::group(['prefix' => 'user'], function () {

  //login
  Route::get('/login', 'UserAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'UserAuth\LoginController@login');
  Route::post('/logout', 'UserAuth\LoginController@logout')->name('logout');

  //register
  Route::get('/register', 'UserAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'UserAuth\RegisterController@register');

  //forgot password
  Route::post('/password/email', 'UserAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'UserAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'UserAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'UserAuth\ResetPasswordController@showResetForm');
});