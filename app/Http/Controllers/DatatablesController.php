<?php

namespace App\Http\Controllers;


use DB;
use App\site;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use Yajra\Datatables\Datatables;


class DatatablesController extends Controller
{
   
    public function index()
    {
        return view('datatables.index');
    }

   /* public function data()

    {
    	
        return Datatables::of(\App\site::all())
        	->make(true);
    }*/
    protected function values()
    {
        $siteinfo = site::all();
        //DB::table('logs')->get();

        //php artisan make: model tblname(no query needed)

        return view('popup.sitelisttbl', compact('siteinfo'));
    }
   protected function data(){


    		$users = DB::table('site')
            ->join('logs', 'site.id', '=', 'logs.site_id')
            ->select('site.name','logs.site_id','logs.datetime_10mins','logs.data_10mins','logs.datetime_20mins','logs.data_20mins','logs.datetime_30mins','logs.data_30mins','logs.rain10')
           
            ->get();

            return Datatables::of($users)
        	->make(true);  

   //   ->where('logs.site_id',)
        	//return $dtable;

        	//return view('datatables.index',compact('dtable'));      	
        }
        protected function datafl($siteid){
            $users = DB::table('site')
            ->join('logs', 'site.id', '=', 'logs.site_id')
            ->select('site.name','logs.site_id','logs.datetime_10mins','logs.data_10mins','logs.datetime_20mins','logs.data_20mins','logs.datetime_30mins','logs.data_30mins','logs.rain10')
            ->where('logs.site_id',$siteid)
            ->get();

            return  Datatables::of($users)->editColumn('rain10', function($user){
                if($user->rain10 > 0){
                    return "<div class='alert-success text-center'>".$user->rain10."</div>";
                }
                elseif($user->rain10 <= 0){
                    return "<div class='alert-info text-center'>".$user->rain10."</div>";
                };
            })
            ->make(true); 
            
            
        }
}