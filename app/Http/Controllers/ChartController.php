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
    	$data = logs::select('datetime_10mins as 0','rain10 as 1')
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
      $data = logs::select('datetime_10mins as 0','data_10mins as 1')
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
