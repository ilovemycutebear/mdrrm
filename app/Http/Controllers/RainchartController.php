<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\site;

class RainchartController extends Controller
{
    //
        public function view(site $rchartid){

    	//$rnvalue = logs::find($id);

    	//return $rnvalue;
    	//$rnvalue = logs::find($id); 

    	return view('charts.laracharts',compact('rchartid'));
        //return $rchartid;

    }
}
