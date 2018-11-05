<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class site extends Model
{
    //
    protected $table = 'site';

    	public function logger() {
        return $this->hasMany('App\logs'); // this matches the Eloquent model
    }
}
