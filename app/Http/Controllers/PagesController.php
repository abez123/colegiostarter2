<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PagesController extends Controller {


public function __construct()
    {
        $this->middleware('auth');
    }


	public function welcome()
	{
		
	}

	public function about()
	{
		return view('pages.about');
	}

	public function contact()
	{
		return view('pages.contact');
	}

}
