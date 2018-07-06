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

Auth::routes();
Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'SearchController@autocomplete'));

Route::group(['prefix' => '/', 'middleware' => 'auth'], function() {

Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('manage_customers', ['as' => 'manage_customers', 'uses' => 'CustomerController@manage_customers']);

Route::post('manage_customers', ['as' => 'manage_customers', 'uses' => 'CustomerController@manage_customers_save']);
Route::get('update_customer/{id}', ['as' => 'update_customer', 'uses' => 'CustomerController@update_customer']);
Route::post('update_customer/{id}', ['as' => 'update_customer_save', 'uses' => 'CustomerController@update_customer_save']);
Route::get('delete_customer/{id}', ['as' => 'delete_customer', 'uses' => 'CustomerController@delete_customer']);

Route::get('customer_list', ['as' => 'customer_list', 'uses' => 'CustomerController@customer_list']);


Route::get('manage_driver', ['as' => 'manage_driver', 'uses' => 'DriverController@manage_driver']);
Route::post('manage_driver', ['as' => 'manage_driver', 'uses' => 'DriverController@manage_driver_save']);
Route::get('update_driver/{id}', ['as' => 'update_driver', 'uses' => 'DriverController@update_driver']);
Route::post('update_driver/{id}', ['as' => 'update_driver', 'uses' => 'DriverController@update_driver_save']);
Route::get('delete_driver/{id}', ['as' => 'delete_driver', 'uses' => 'DriverController@delete_driver']);

Route::get('manage_zones', ['as' => 'manage_zones', 'uses' => 'DriverController@manage_zones']);

Route::post('manage_zones', ['as' => 'manage_zones', 'uses' => 'DriverController@manage_zones_save']);
Route::get('delete_zone/{id}', ['as' => 'delete_zone', 'uses' => 'DriverController@delete_zone']);

Route::get('driver_list', ['as' => 'driver_list', 'uses' => 'DriverController@driver_list']);

/////////////////////////////////////////////Facture routes

Route::get('create_facture', ['as' => 'create_facture', 'uses' => 'FactureController@create_facture']);
Route::post('create_facture', ['as' => 'create_facture', 'uses' => 'FactureController@create_facture_save']);

Route::get('manage_facture', ['as' => 'manage_facture', 'uses' => 'FactureController@manage_facture']);
Route::get('detail_facture/{id}/{c_id}/{z_id}', ['as' => 'detail_facture', 'uses' => 'FactureController@detail_facture']);
Route::post('detail_facture/{id}/{c_id}/{z_id}', ['as' => 'detail_facture', 'uses' => 'FactureController@detail_facture_assign']);
Route::get('factures_stat', ['as' => 'factures_stat', 'uses' => 'FactureController@factures_stat']);
Route::get('edit_facture/{id}', ['as' => 'edit_facture', 'uses' => 'FactureController@edit_facture']);
Route::post('edit_facture/{id}', ['as' => 'edit_facture', 'uses' => 'FactureController@edit_facture_save']);

Route::get('return_facture/{id}', ['as' => 'return_facture', 'uses' => 'FactureController@return_facture']);

Route::get('paid_facture/{id}', ['as' => 'paid_facture', 'uses' => 'FactureController@paid_facture']);
Route::get('werehouse', ['as' => 'werehouse', 'uses' => 'FactureController@werehouse']);
Route::get('werhouse_checkout', ['as' => 'werhouse_checkout', 'uses' => 'FactureController@werhouse_checkout']);
Route::post('werhouse_checkout', ['as' => 'werhouse_checkout', 'uses' => 'FactureController@werhouse_checkout_assign']);

Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);

///////////////////Statistics


Route::get('customer_factures/{id}', ['as' => 'customer_factures', 'uses' => 'StatisticController@customer_factures']);


Route::post('customer_factures/{id}', ['as' => 'customer_factures', 'uses' => 'StatisticController@customer_factures_search']);


Route::get('driver_factures/{id}', ['as' => 'driver_factures', 'uses' => 'StatisticController@driver_factures']);

Route::post('edit_facture_dri/{id}', ['as' => 'edit_facture_dri', 'uses' => 'StatisticController@edit_facture_dri']);

Route::get('customer_factures/print_selected/{ids}', ['as' => 'print_selected', 'uses' => 'StatisticController@print_selected']);
Route::get('driver_factures/print_selected_drivers/{ids}', ['as' => 'print_selected_drivers', 'uses' => 'StatisticController@print_selected_drivers']);

///////////////////Search Controller
Route::get('search', ['as' => 'search', 'uses' => 'SearchController@index']);
Route::post('search_action/{tag}', ['as' => 'search_action', 'uses' => 'SearchController@search_action']);



});
