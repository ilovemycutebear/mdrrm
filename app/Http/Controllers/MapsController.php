<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\site;

use App\Http\Requests;

use Carbon\Carbon;

use DateTime;

class MapsController extends Controller
{
	public function index(){



		return view('mapa.hompg');
	}
        public function wlindex(){


            $alarms = DB::table('site')->select('id','name','wlalert','wlalarm','wlcritical','sensortype')->where('sensortype',1)->orWhere('sensortype',3)->get();

            

        return view('mapa.wlhompg',compact($alarms));
    }
    //query 
    //SELECT site.name as 
    //Site,site.sitelat as lattitude ,site.sitelong as longtitude,logs.rain10 as rainten,logs.datetime_10mins as asof, 
    //logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE cnt 
    //IN (SELECT MAX(cnt) FROM logs GROUP BY site_id)
    public function geoinfo(){

    	//$siteinfo = site::all();

    	$query= DB::select("SELECT site.name as Site,site.sitelat as lattitude ,site.sitelong as longtitude,logs.rvalue as rainten,logs.created_at as asof, logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE logs.cnt IN (SELECT MAX(cnt) FROM logs GROUP BY site_id) AND (site.sensortype = 1 OR site.sensortype = 3)");

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



        /*$date = new DateTime();
        $date->modify('-3 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $lb = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->where('created_at', '>',$formatted_date)->groupBy('created_at')->sum('rvalue');


        return $lb;*/
        $date = new DateTime();
        //$date->modify('-24 hours');
        $formatted_date = Carbon::now()->subDays(1);
        $visitCount = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->select(DB::raw("SUM(rvalue) as rain"),'logs.site_id','logs.created_at','site.name','site.sensortype','site.sitelong','site.sitelat')->where('logs.created_at', '>',$formatted_date)
        ->where(function ($query) {
        $query->where('site.sensortype','=',1)
        ->orWhere('site.sensortype','=',3);
        })
        ->groupBy('site_id')->get();


// This will hold the count for you

// This will hold the count for you
    
        
        //$finalresult;
        //$lb = DB::table('logs')->where('created_at', '>', NOW() - INTERVAL 3 HOUR);
        
        $result = array();          
         
    	foreach ($query as $queries){ 
    	

    	array_push($result, array(


								  'type' => "Feature",
								  'properties'	=> array(
								  				             "marker-color"=> "tenmmins",
        													"marker-size"=> "medium",
        												    "marker-symbol"=> "water",
        													"description"=> array(
        														"Sitename"=>$queries->Site,
        														"rainfall" => (float)$queries->rainten,
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
        }
		foreach ($visitCount as $daily){


        $twolong=(float)$daily->sitelong+0.00030;
        $twolat=(float)$daily->sitelat+0.00030;
            array_push($result, array(


                                  'type' => "Feature",
                                  'properties'  => array(
                                                             "marker-color"=> "daily",
                                                            "marker-size"=> "medium",
                                                            "marker-symbol"=> "water",
                                                            "description"=> array(
                                                                "Sitename"=>$daily->name,
                                                                "rainfall" => (float)$daily->rain,
                                                                "site_id" => $daily -> site_id,
                                                                "dataof" => "daily"
                                                                        )

                                                        ),
                                  'geometry'=> array(

                                                    "type"=> "Point",

                                                    "coordinates"=> array(
                                                                            $twolong,
                                                                            $twolat


                                                                        )
                                                    ),
//                                'site_name' => $row['Site'],
//                                'site_lattitude' => $row['lattitude'],
//                                'site_longtitude' => $row['longtitude']
                                  ));
        }


		$whole = json_encode(array(
									"type" => "FeatureCollection",
									"features" => $result



								 ));
		return $whole;
	
		


	}//geoinfo
    public function wlgeoinfo(){

        //$siteinfo = site::all();

        $query= DB::select("SELECT site.name as Site,site.sitelat as lattitude ,site.sitelong as longtitude,site.wltbm as tbm,site.wly as ylevel,site.wlalert as wlalert,site.wlalarm as wlalarm,site.wlcritical as wlcritical,logs.wlevel as water,logs.created_at as asof, logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE logs.cnt IN (SELECT MAX(cnt) FROM logs GROUP BY site_id) AND (site.sensortype = 2 OR site.sensortype = 3)");

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



        /*$date = new DateTime();
        $date->modify('-3 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $lb = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->where('created_at', '>',$formatted_date)->groupBy('created_at')->sum('rvalue');


        return $lb;*/
        $date = new DateTime();
        //$date->modify('-24 hours');
        $formatted_date = Carbon::now()->subDays(1);
        $visitCount = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->select(DB::raw("SUM(wlevel) as dlwater"),'logs.site_id','logs.created_at','site.name','site.sensortype','site.sitelong','site.sitelat','site.wlalert','site.wlalarm','site.wlcritical')->where('logs.created_at', '>',$formatted_date)
        ->where(function ($query) {
        $query->where('site.sensortype','=',1)
        ->orWhere('site.sensortype','=',3);
        })
        ->groupBy('site_id')->get();


// This will hold the count for you

// This will hold the count for you
    
        
        //$finalresult;
        //$lb = DB::table('logs')->where('created_at', '>', NOW() - INTERVAL 3 HOUR);
        
        $result = array();          
         
        foreach ($query as $queries){ 
        

        array_push($result, array(


                                  'type' => "Feature",
                                  'properties'  => array(
                                                             "marker-color"=> "#00f9ff",
                                                            "marker-size"=> "medium",
                                                            "marker-symbol"=> "water",
                                                            "description"=> array(
                                                                "Sitename"=>$queries->Site,
                                                                "wlevel" => (float)$queries->water,
                                                                "wlalert" => (float)$queries->wlalert,
                                                                "wlalarm" => (float)$queries->wlalarm,
                                                                "wlcritical" => (float)$queries->wlcritical,
                                                                "tbm" => (float)$queries->tbm,
                                                                "ylevel" => (float)$queries->ylevel,
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
//                                'site_name' => $row['Site'],
//                                'site_lattitude' => $row['lattitude'],
//                                'site_longtitude' => $row['longtitude']
                                  ));
        }
       /* foreach ($visitCount as $daily){


        $twolong=(float)$daily->sitelong+0.01000;
        $twolat=(float)$daily->sitelat+0.01000;
            array_push($result, array(


                                  'type' => "Feature",
                                  'properties'  => array(
                                                             "marker-color"=> "#00f9ff",
                                                            "marker-size"=> "medium",
                                                            "marker-symbol"=> "water",
                                                            "description"=> array(
                                                                "Sitename"=>$daily->name,
                                                                "wlevel" => (float)$daily->dlwater,
                                                                "site_id" => $daily -> site_id,
                                                                "dataof" => "daily"
                                                                        )

                                                        ),
                                  'geometry'=> array(

                                                    "type"=> "Point",

                                                    "coordinates"=> array(
                                                                            $twolong,
                                                                            $twolat


                                                                        )
                                                    ),
//                                'site_name' => $row['Site'],
//                                'site_lattitude' => $row['lattitude'],
//                                'site_longtitude' => $row['longtitude']
                                  ));
        }*/


        $whole = json_encode(array(
                                    "type" => "FeatureCollection",
                                    "features" => $result



                                 ));
        return $whole;
    
        


    }
}
