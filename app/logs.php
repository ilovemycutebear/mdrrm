<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class logs extends Model
{
    protected $casts = [
    'rain10' => 'integer',
    'datetime_10mins' => 'datetime'
	
	];

     protected $table = 'logs';

        public function siteinfo(){

    	return $this -> belongsTo('App\site','site_id');


    }

    


//DB::listen(function($query) { var_dump($query->sql); });
// php artisan tinker echo query
}
