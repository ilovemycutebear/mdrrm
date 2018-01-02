<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\site;

use App\Http\Requests;

class MapsController extends Controller
{
	public function index(){



		return view('mapa.hompg');
	}
    //query 
    //SELECT site.name as 
    //Site,site.sitelat as lattitude ,site.sitelong as longtitude,logs.rain10 as rainten,logs.datetime_10mins as asof, 
    //logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE cnt 
    //IN (SELECT MAX(cnt) FROM logs GROUP BY site_id)
    public function geoinfo(){

    	//$siteinfo = site::all();

    	$query= DB::select("SELECT site.name as Site,site.sitelat as lattitude ,site.sitelong as longtitude,logs.rain10 as rainten,logs.datetime_10mins as asof, logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE logs.cnt IN (SELECT MAX(cnt) FROM logs GROUP BY site_id)");

       	/*$results = DB::table('site')
            ->join('logs', 'site.id', '=', 'logs.site_id')
            ->select('site.name as site_name','site.sitelong as longtitude','site.sitelat as lattitude','logs.site_id','logs.datetime_10mins','logs.rain10')
            ->whereIn('logs.cnt', function ($query){

            	 $query->select(*)
            	 ->from('logs')->getTable()
                 ->groupBy('site_id')
                 ->max('logs.cnt');
                     
            })
            ->get(); */


            //$query ->max('cnt')->from('logs')->groupBy('site_id');
 $result = array();          
         
    	foreach ($query as $queries) 
    
			

    	array_push($result, array(


								  'type' => "Feature",
								  'properties'	=> array(
								  				             "marker-color"=> "#00f9ff",
        													"marker-size"=> "medium",
        												    "marker-symbol"=> "water",
        													"description"=> array(
        														"Sitename"=>$queries->Site,
        														"rainfall" => $queries->rainten,
        														"asof" => $queries->asof,
        														"site_id" => $queries -> siteid
        																)

								  						),
								  'geometry'=> array(

								  					"type"=> "Point",

								  					"coordinates"=> array(
								  											(float)$queries->longtitude,
								  											(float)$queries->lattitude


								  										)
								  					),
//								  'site_name' => $row['Site'],
//								  'site_lattitude' => $row['lattitude'],
//								  'site_longtitude' => $row['longtitude']
								  ));
		

		$whole = json_encode(array(
									"type" => "FeatureCollection",
									"features" => $result



								 ));
		return $whole;
	
		


	}
}
