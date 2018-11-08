<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use View;
use Auth;

# Global Definitions
use App\Model\Definitions;
use App\Model\Modules;




class CmsController extends Controller
{
	public function __construct(Request $request)
	{
		$definitions = Definitions::first();	

		View::share(array(
			"definitions"   => $definitions,
			"pages_unic" => Modules::where('type_module', '1')->where('status', '1')->get(),
			"pages_list" => Modules::where('type_module', '2')->where('status', '1')->get(),		
		));
	} 
}



