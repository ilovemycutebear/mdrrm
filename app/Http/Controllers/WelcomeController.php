<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use DateTime;
use App\logs;
use App\site;
use App\computedlogs;
use App\tblcompare;
use Carbon\Carbon;

use App\Http\Requests;
use Yajra\Datatables\Datatables;

class WelcomeController extends Controller
{
    //LatestAllData
     public function LatestAllData(){
		$latestcrsl = DB::select("SELECT site.name as Site,site.sitelat as lattitude ,site.sitelong as longtitude,FORMAT(logs.rvalue, 2)as rainten,FORMAT(logs.wlevel, 2)as wlevel,logs.created_at as asof, logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE logs.cnt IN (SELECT MAX(cnt) FROM logs GROUP BY site_id) AND (site.sensortype = 1 OR site.sensortype = 2 OR site.sensortype = 3)ORDER BY CAST(site.wltbm AS UNSIGNED ) DESC");

		
		

		return view('latest.carousel',compact('latestcrsl'));
		//return $latestcrsl;
		
				}
}
