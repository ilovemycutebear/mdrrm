<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\site;


use App\Http\Requests;


class TabController extends Controller
{
    //
    public function getLaraTab(site $tabid){

    	/*$tabinfo = DB::table('site')
            ->join('logs', 'site.id', '=', 'logs.site_id')
            ->select('site.name','logs.site_id','logs.datetime_10mins','logs.data_10mins','logs.datetime_20mins','logs.data_20mins','logs.datetime_30mins','logs.data_30mins','logs.rain10')
            ->where('logs.site_id',$tabid)
            ->take(1)
            ->get(); */

    	return view('tabs.tabmenu',compact('tabid'));
        //return $tabid;

    }
}
