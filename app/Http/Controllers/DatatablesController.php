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
            ->select('site.name','logs.radiodate','logs.radiotime','logs.batteryvolt','logs.wlevel','logs.rvalue')
           
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
            ->select('site.name','logs.radiodate','logs.radiotime','logs.batteryvolt','logs.wlevel','logs.rvalue')
            ->where('logs.site_id',$siteid)
            ->get();

            return  Datatables::of($users)->editColumn('rvalue', function($user){
                if($user->rvalue > 0){
                    return "<div class='alert-success text-center'>".$user->rvalue."</div>";
                }
                elseif($user->rvalue <= 0){
                    return "<div class='alert-info text-center'>".$user->rvalue."</div>";
                };
            })
            ->make(true); 
            
            
        }
        public function editalerts(){

             return view('datatables.editalerts');
        }
        public function editalertsdata(){


              $users = DB::table('site')
            ->select(['name', 'sitelat', 'sitelong', 'sitelev', 'wlalert', 'wlalarm','wlcritical'])->where(function ($query) {
        $query->where('sensortype','=',1)
        ->orWhere('sensortype','=',3);
        })->get();

   

            return Datatables::of($users)->editColumn('wlalert', function($user){
                    return "<div class='alert-success text-center'>".$user->wlalert."</div>";
            })->editColumn('wlalarm', function($user){
                    return "<div class='alert-warning text-center'>".$user->wlalarm."</div>";
            })->editColumn('wlcritical', function($user){
                    return "<div class='alert-danger text-center'>".$user->wlcritical."</div>";
            })
            ->make(true);  
        }
}