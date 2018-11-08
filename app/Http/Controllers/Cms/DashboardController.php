<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



# Analytics
use App\Classes\Analytics;
New Analytics($_SERVER['REMOTE_ADDR']);


class DashboardController extends CmsController
{
	use AuthenticatesUsers;

	public function index()
	{	
		return view("cms/pages/dashboard/index", array(
			"day" => Analytics::countVisitors(1),
			"week" => Analytics::countVisitors(2),
			"month" => Analytics::countVisitors(3),
			"year" => Analytics::countVisitors(4),
		));
	}
}
