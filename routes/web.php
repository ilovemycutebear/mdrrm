<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*Route::get('/', function () {
	$places = ['Philippines','Korea','Japan'];
    return view('welcome', compact('places'));
});*/

Route::get('/', 'PagesController@home');
Route::get('about', 'PagesController@about');

Route::get('map', 'MapsController@geoinfo');
Route::get('mapview', 'MapsController@index');
Route::get('raintips','RaintipsController@values');
Route::get('datatable/{sitelog}','RaintipsController@show');
Route::get('rainchart/{rchartid}','RainchartController@view');
Route::get('siteinfo','DatatablesController@index');
Route::get('data','DatatablesController@values');
Route::get('data/{siteid}','DatatablesController@datafl');
Route::get('joined','DatatablesController@InnJoin');
Route::get('laracharts/{chartid}', 'ChartController@getLaraChart');
Route::get('wlaracharts/{chartid}', 'ChartController@getwlLaraChart');
Route::get('latestdata/', 'LatestController@getlatestdata');
Route::get('tabs/{tabid}', 'TabController@getLaraTab');
//Route::get('/datatables/orders', array('auth', 'uses' => 'ProfileController@anyOrders'))->name('datatables.dataOrders');
//Route::get('/datatables/properties', array('uses' => 'ProfileController@anyProperties'))->name('datatables.dataProperties');