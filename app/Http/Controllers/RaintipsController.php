<?php

namespace App\Http\Controllers;

use DB;

use App\site;


use Illuminate\Http\Request;

use App\Http\Requests;

class RaintipsController extends Controller
{
    //
    public function values()
    {
    	$siteinfo = site::all();
    	//DB::table('logs')->get();

    	//php artisan make: model tblname(no query needed)

    	return view('rainvalues.tips', compact('siteinfo'));
    }

    public function show(site $sitelog){

    	//$rnvalue = logs::find($id);

    	//return $rnvalue;
    	//$rnvalue = logs::find($id); 

    	return view('datatables.index',compact('sitelog'));
        //return $sitelog;

    }
}
