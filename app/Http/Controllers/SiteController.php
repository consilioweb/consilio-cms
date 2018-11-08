<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;


# Global
use App\Model\Definitions;

# Analytics
use App\Classes\Analytics;
New Analytics($_SERVER['REMOTE_ADDR']);
class SiteController extends Controller
{
	public function __construct(Request $request)
	{	

		//parent::__construct();   
		View::share(array(
			"defintions"   => "defintions"
		));    
	}  
}
