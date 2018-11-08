<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;
use App\Model\Adverts;



class advertsController extends CmsController
{

	public function index(Request $request)
	{
		$adverts = Adverts::orderBy("adverts_id", "DESC");

		if($request->input('title'))
		{
			$adverts->where('title', 'like', '%'.$request->input('title').'%');
		}

		if($request->input('status'))
		{
			$adverts->where('status', $request->input('status'));
		}


		$pages = Modules::where('status', '1')->get();



		return view("cms/pages/adverts/index", array(
			"adverts" => $adverts->paginate(50),
			"user" => $user,
		));
	}


}
