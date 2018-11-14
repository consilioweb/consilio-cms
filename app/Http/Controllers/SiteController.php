<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use View;


# Global
use App\Model\Definitions;
use App\Model\Site;

# Analytics
use App\Classes\Analytics;
New Analytics($_SERVER['REMOTE_ADDR']);
class SiteController extends Controller
{
	public function __construct(Request $request)
	{	
		$definitions = Definitions::first();
		$site = Site::first();
		//parent::__construct();   
		View::share(array(
			"defintions"   	=> $definitions,
			"site"   		=> $site,
		));    
	}  
}
