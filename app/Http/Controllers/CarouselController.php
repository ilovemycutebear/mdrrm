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

class CarouselController extends Controller
{
    //
    public function getlatestCarouseldata(){
		$latestcrsl = DB::select("SELECT site.name as Site,site.sitelat as lattitude ,site.sitelong as longtitude,FORMAT(logs.rvalue, 2)as rainten,FORMAT(logs.wlevel,2) as water,logs.created_at as asof, logs.site_id as siteid FROM site INNER JOIN logs on site.id=logs.site_id WHERE logs.cnt IN (SELECT MAX(cnt) FROM logs GROUP BY site_id) AND (site.sensortype = 2 OR site.sensortype = 3)ORDER BY CAST(site.wltbm AS UNSIGNED ) ASC");

		
		

		return view('latest.carousel',compact('latestcrsl'));
		//return $latestcrsl;
		
				}
}
