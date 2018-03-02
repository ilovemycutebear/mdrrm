<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DateTime;
use App\logs;
use App\site;
use App\tblcompare;
use Carbon\Carbon;

use App\Http\Requests;
use Yajra\Datatables\Datatables;



class LatestController extends Controller
{
    //
    public function wlgetlatestdata(){
		$result = DB::select("SELECT site.name as Site,site.sitelat as lattitude ,site.sitelong as longtitude,(site.wltbm-site.wly)+logs.wlevel as water,logs.created_at as asof, logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE logs.cnt IN (SELECT MAX(cnt) FROM logs GROUP BY site_id) AND (site.sensortype = 1 OR site.sensortype = 3)");


 		/*DB::table('tblcompare')->insert(
    					['wleveldata' => $result -> water, 'siteid' =>  $result -> siteid]
			);*/
 		
		

 /*foreach ($result as $results){ 

    tblcompare::where('site_id', $results -> siteid)
          ->update(['wleveldata'=>$results -> water,'created_at'=>$results -> asof,'updated_at'=>$results -> asof]);

	
 }*/
	$parsed['data'] = $result;
		
		return $parsed;
		

				}
	public function wlgethourlydata(){


		/*$date = new DateTime();
		$date->modify('-3 hours');
		$formatted_date = $date->format('Y-m-d H:i:s');
		$lb = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->where('created_at', '>',$formatted_date)->groupBy('created_at')->sum('rvalue');


		return $lb;*/
		$date = new DateTime();
		//$date->modify('-24 hours');
		$formatted_date = Carbon::now()->subDays(1);
		$visitCount = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->select(DB::raw("SUM((site.wltbm-site.wly)+logs.wlevel) as water"),'logs.site_id','logs.created_at','site.name','site.sensortype')->where('logs.created_at', '>',$formatted_date)
		->where(function ($query) {
    	$query->where('site.sensortype','=',1)
        ->orWhere('site.sensortype','=',3);
    	})
		->groupBy('site_id')->get();

		return Datatables::of($visitCount)->make(true);
		
     	//$finalresult;
		//$lb = DB::table('logs')->where('created_at', '>', NOW() - INTERVAL 3 HOUR);
		
	}
	 public function getlatestdata(){
		$result = DB::select("SELECT site.name as Site,site.sitelat as lattitude ,site.sitelong as longtitude,logs.rvalue as rainten,logs.created_at as asof, logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE logs.cnt IN (SELECT MAX(cnt) FROM logs GROUP BY site_id) AND (site.sensortype = 2 OR site.sensortype = 3)");

		$parsed['data'] = $result;
		
		return $parsed;
	
		

				}
	public function gethourlydata(){


		/*$date = new DateTime();
		$date->modify('-3 hours');
		$formatted_date = $date->format('Y-m-d H:i:s');
		$lb = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->where('created_at', '>',$formatted_date)->groupBy('created_at')->sum('rvalue');


		return $lb;*/
		$date = new DateTime();
		//$date->modify('-24 hours');
		$formatted_date = Carbon::now()->subDays(1);
		$visitCount = DB::table('logs')->join('site', 'site.id', '=', 'logs.site_id')->select(DB::raw("SUM(rvalue) as rain"),'logs.site_id','logs.created_at','site.name','site.sensortype')->where('logs.created_at', '>',$formatted_date)
		->where(function ($query) {
    	$query->where('site.sensortype','=',2)
        ->orWhere('site.sensortype','=',3);
    	})
		->groupBy('site_id')->get();

// This will hold the count for you
		return Datatables::of($visitCount)->make(true);
		
	}

}
