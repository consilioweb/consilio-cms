<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\AdLocations;



class LocationsAdvertsController extends CmsController
{

	public function index(Request $request)
	{

		$adverts_locations = AdLocations::orderBy("ad_locations_id", "DESC");

		return view("cms/pages/adverts-locations/index", array(
			"adverts_locations" => $adverts_locations->paginate(50),
		));
	}
 


	public function create()
	{
		return view("cms/pages/adverts-locations/show");
	}


	public function store(Request $request)
	{
		try {

			$request->merge(array(
				'status' =>  '1'
			));
			$adverts_locations = AdLocations::create($request->all());
			return redirect(route('cms-adverts-locations-show', $adverts_locations->ad_locations_id)); 
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
			return redirect(route('cms-adverts-locations')); 
		}        
	}


	public function show($id)
	{   		


		$adverts_locations = AdLocations::find($id);

		if (empty($adverts_locations)) {
			abort(404);
		}

		return view("cms/pages/adverts-locations/show", array(
			"adverts_locations" => $adverts_locations,
		));
	}


	public function update(Request $request, $id)
	{

		try {
			AdLocations::find($id)->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-adverts-locations'));
	}


	public function destroy(Request $request, $id)
	{
		try {
			$adverts_locations = AdLocations::find($id);

			if(empty($adverts_locations)) {
				abort(404);
			}

			$adverts_locations->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-adverts-locations'));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$adverts_locations = AdLocations::find($id);

			if(empty($adverts_locations)) {
				abort(404);
			}

			if($action == "desativar"){
				$adverts_locations->update(['status' => '2']);
			}else if($action == "ativar"){
				$adverts_locations->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-adverts-locations'));
	}


} 