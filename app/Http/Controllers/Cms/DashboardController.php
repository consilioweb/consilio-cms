<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class DashboardController extends CmsController
{
	use AuthenticatesUsers;

	public function index()
	{	
		return view("cms/pages/dashboard/index");
	}
}
