<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Model\Modules;

class DashboardController extends Controller
{
	use AuthenticatesUsers;

	public function index()
	{	
		$users = Auth::user();

		$modules = Modules::where('status', '1')->get();
		return view("cms/pages/dashboard/index", array(
			"users" => $users,
			"pages" => $modules,
			"pages_unic" => Modules::where('type_module', '1')->where('status', '1')->get(),
			"pages_list" => Modules::where('type_module', '2')->where('status', '1')->get(),
		));
	}
}
