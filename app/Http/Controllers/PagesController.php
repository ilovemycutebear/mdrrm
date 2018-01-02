<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    //
    public function home()
    {
    	$places = ['Philippines','Korea','Japan'];
    	return view('welcome', compact('places'));
    }
    public function about()
    {

    	return view('about.about');
    }
}
