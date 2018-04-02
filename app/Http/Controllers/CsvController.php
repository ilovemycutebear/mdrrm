<?php

namespace App\Http\Controllers;

use DB;
use App\site;
use Illuminate\Http\Request;
use App\User;
use App\computedlogs;
use App\Http\Requests;
use Yajra\Datatables\Datatables;

class CsvController extends Controller
{
    //

    public function exportdata()
    {

    	return view('export.export');
    }
}
