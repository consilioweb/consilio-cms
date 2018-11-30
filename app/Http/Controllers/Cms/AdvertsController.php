<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request; 

use App\Http\Requests;
use App\Model\Modules;
use App\Model\AdBanners;
use App\Model\AdClients;
use App\Model\AdLocations;



class AdvertsController extends CmsController
{

	public function index(Request $request)
	{
		$adverts = AdBanners::orderBy("ad_banners_id", "DESC");

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
		));
	}



	public function create()
	{

		$clients = AdClients::all()->pluck('title', 'ad_clients_id');
		$locations = AdLocations::all()->pluck('title', 'ad_locations_id');


		return view("cms/pages/adverts/show", array(
			"clients" => $clients,
			"locations" => $locations,
		));
	}


	public function store(Request $request)
	{


		$request->merge(array(
			'status' =>  '1'
		));


		if($request->hasFile('image')) {

			$file = $request->file('image');
			$input['imagename'] = md5(time()).'.'.$file->getClientOriginalExtension();
			$name_img = md5(time()).'.'.$file->getClientOriginalExtension();
			$destinationPath = public_path('storage/files/');
			$file->move($destinationPath, $input['imagename']);
			$request->merge(array(
				'file' =>  $name_img,
			));
		}


		try {
			$adverts = AdBanners::create($request->all());
			return redirect(route('cms-adverts-show', $adverts->ad_banners_id)); 
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
			return redirect(route('cms-adverts')); 
		}        
	}


	public function show($id)
	{   

		


		$adverts = AdBanners::find($id);

		if (empty($adverts)) {
			abort(404);
		}


		$clients = AdClients::all()->pluck('title', 'ad_clients_id');
		$locations = AdLocations::all()->pluck('title', 'ad_locations_id');

		return view("cms/pages/adverts/show", array(
			"adverts" => $adverts,
			"clients" => $clients,
			"locations" => $locations,
		));
	}


	public function update(Request $request, $id)
	{

		try {

			AdBanners::find($id)->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-adverts'));
	}


	public function destroy(Request $request, $id)
	{
		try {
			$adverts = AdBanners::find($id);

			if(empty($adverts)) {
				abort(404);
			}

			$adverts->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-adverts'));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$adverts = AdBanners::find($id);

			if(empty($adverts)) {
				abort(404);
			}

			if($action == "desativar"){
				$adverts->update(['status' => '2']);
			}else if($action == "ativar"){
				$adverts->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-adverts'));
	}


}
