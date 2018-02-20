<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use DB;
use App\logs;
use App\User;

class ChartController extends Controller
{
    //
       public function getLaraChart($chartid)
    {
    	$lava = new Lavacharts;

    	$charth = $lava->DataTable();
    	$data = logs::select('created_at as 0','rvalue as 1')
    	->where('site_id',$chartid)
        ->take(10010)
    	->get()->toArray();

           // $users = str_replace('{', '[', $users);
            //$users = str_replace('}', ']', $users);
         $charth->addDateTimeColumn('Date/Time')
		          ->addNumberColumn('Rain')
		          ->addRows($data);

		//$lava->LineChart('Popularity', $charth);


        //return view('charts.laracharts',compact('lava'));
		return $charth;
        //->join('logs', 'site.id', '=', 'logs.site_id')
    
        
    }
           public function getwlLaraChart($chartid)
    {
      $lava = new Lavacharts;

      $wlcharth = $lava->DataTable();
      $data = logs::join('site', 'site.id', '=', 'logs.site_id')
      ->select(DB::raw('logs.created_at as "0",(site.wltbm-site.wly)+logs.wlevel as "1"'))
      ->where('site_id',$chartid)
     ->take(10010)
      ->get()->toArray();

           // $users = str_replace('{', '[', $users);
            //$users = str_replace('}', ']', $users);
         $wlcharth->addDateTimeColumn('Date/Time')
              ->addNumberColumn('Water Level')
              ->addRows($data);

    //$lava->LineChart('Popularity', $charth);


        //return view('charts.laracharts',compact('lava'));
    return $wlcharth;
        //->join('logs', 'site.id', '=', 'logs.site_id')
    
        
    }
}
