<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\logs;

use App\Http\Requests;

class LatestController extends Controller
{
    //
    public function getlatestdata(){


    	$latestdt = DB::select("SELECT tt.*,site.name FROM logs tt INNER JOIN (SELECT site_id, MAX(datemrcvd) AS MaxDateTime FROM logs GROUP BY site_id) groupedtt ON tt.site_id = groupedtt.site_id AND tt.datemrcvd = groupedtt.MaxDateTime INNER JOIN site on tt.site_id = site.id");

    	return view('latest.carousel',compact('latestdt'));
    	//return $latestdt;
	}
}
