<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use App\logs;
use App\site;
use App\computedlogs;
use App\tblcompare;
use Carbon\Carbon;

use App\Http\Requests;
use Yajra\Datatables\Datatables;


class historicalController extends Controller
{
    	public function wlgetsitedata(){
		$result = DB::select("SELECT site.name as Site, site.id as site_id FROM site WHERE (site.sensortype = 1 OR site.sensortype = 3)");


	$parsed['data'] = $result;
		
		return $parsed;
		

				}
		public function rngetsitedata(){
		$result = DB::select("SELECT site.name as Site, site.id as site_id FROM site WHERE (site.sensortype = 2 OR site.sensortype = 3)");


	$parsed['data'] = $result;
		
		return $parsed;
		

				}
						public function hstry(){
		
					
        return view('datatables.historical');

				}
}
