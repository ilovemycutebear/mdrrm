<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tblcompare extends Model
{
    //
      protected $table = 'tblcompare';
      protected $primaryKey = 'site_id';
      protected $fillable = ['wleveldata', 'site_id', 'created_at','updated_at'];
}
