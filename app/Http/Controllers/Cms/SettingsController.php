<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

# Models
use App\Model\Definitions;
use App\Model\Site;
use App\Model\States;
use App\Model\Cities;
use App\Model\Modules;



class SettingsController extends CmsController
{
	use AuthenticatesUsers;

	public function system()
	{	

 		$modules = Modules::where('status', '1')->get();
		$definitions = Definitions::first();

		return view("cms/pages/settings/system", array(			
			"definitions" => $definitions,
			"pages" => $modules,
		));
	}

	public function systemUpdate(Request $request)
	{

		/* ~ Informações de Checkbox ~*/
		if($request->input('adverts') == "on"){
			$request->merge(array(
				'adverts' =>  '1'
			));
		}else{
			$request->merge(array(
				'adverts' =>  '2'
			));
		}

		if($request->input('polls') == "on"){
			$request->merge(array(
				'polls' =>  '1'
			));
		}else{
			$request->merge(array(
				'polls' =>  '2'
			));
		}

		if($request->input('newsletter') == "on"){
			$request->merge(array(
				'newsletter' =>  '1'
			));
		}else{
			$request->merge(array(
				'newsletter' =>  '2'
			));
		}

		try {

			Definitions::first()->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-settings-system'));
	}

	public function site()
	{	
		$site = Site::first();
		$states = States::where('status', TRUE)->get();
		$cities = Cities::where("states_id", $site->states_id)->get();


 		$modules = Modules::where('status', '1')->get();
		
		return view("cms/pages/settings/site", array(			
			"site" => $site,
			"states" => $states,
			"cities" => $cities,
			"pages" => $modules,
		));
	}


	public function siteUpdate(Request $request)
	{

		try {

			Site::first()->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-settings-site'));

	}
}
