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
Route::get('wlmap', 'MapsController@wlgeoinfo');
Route::get('rainmapview', 'MapsController@index');
Route::get('wlevelmapview', 'MapsController@wlindex');
Route::get('raintips','RaintipsController@values');
Route::get('datatable/{sitelog}','RaintipsController@show');
Route::get('rainchart/{rchartid}','RainchartController@view');
Route::get('siteinfo','DatatablesController@index');
Route::get('editinfo','DatatablesController@editalerts');
Route::post('editinfo/update','DatatablesController@updatealerts');
Route::get('editalerts','DatatablesController@editalertsdata');
Route::get('data','DatatablesController@values');
Route::get('data/{siteid}','DatatablesController@datafl');
Route::get('joined','DatatablesController@InnJoin');
Route::get('laracharts/{chartid}', 'ChartController@getLaraChart');
Route::get('wlaracharts/{chartid}', 'ChartController@getwlLaraChart');
Route::get('latestdata', 'LatestController@getlatestdata');
Route::get('hourlydata', 'LatestController@gethourlydata');
Route::get('wllatestdata', 'LatestController@wlgetlatestdata');
Route::get('wlhourlydata', 'LatestController@wlgethourlydata');
Route::get('tabs/{tabid}', 'TabController@getLaraTab');
Route::get('mapped', function (){

	$config['center'] = '17.513655, 120.671699';
	$config['zoom'] = '9';
	$config['map_height'] = '550px';
	//$config['map_width'] = '550px';
	$config['scrollwheel'] = false;
	$config['geocodeCaching'] = true;
	$config['kmlLayerPreserveViewport'] = true;
	$config['map_type'] = 'ROADMAP';
	

	GMaps::initialize($config);

	//ADD MARKER
	$marker['position'] =  'Air Canada Centre, Toronto';
	$marker['infowindow_content'] =  'pukineyeneymo';
	$marker['icon']='http://maps.google.com/mapfiles/kml/pal3/icon33.png';
	GMaps::add_marker($marker);

	$map = GMaps::create_map();

	 return view('mapa.revised')->with('map',$map);
});
//Route::get('/datatables/orders', array('auth', 'uses' => 'ProfileController@anyOrders'))->name('datatables.dataOrders');
//Route::get('/datatables/properties', array('uses' => 'ProfileController@anyProperties'))->name('datatables.dataProperties');