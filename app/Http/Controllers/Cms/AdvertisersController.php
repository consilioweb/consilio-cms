<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;
use App\Model\AdBanners;
use App\Model\AdClients;
use App\Model\AdLocations;



class AdvertisersController extends CmsController
{

	public function index(Request $request)
	{

		$advertisers = AdClients::orderBy("ad_clients_id", "DESC");

		return view("cms/pages/advertisers/index", array(
			"advertisers" => $advertisers->paginate(50),
		));
	}



	public function create()
	{
		return view("cms/pages/advertisers/show");
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
				'logo' =>  $name_img,
			));
		}


		try {
			$advertisers = AdClients::create($request->all());
			return redirect(route('cms-advertisers-show', $advertisers->ad_clients_id)); 
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
			return redirect(route('cms-advertisers')); 
		}        
	}


	public function show($id)
	{   		


		$advertisers = AdClients::find($id);

		if (empty($advertisers)) {
			abort(404);
		}

		return view("cms/pages/advertisers/show", array(
			"advertisers" => $advertisers,
		));
	}


	public function update(Request $request, $id)
	{

		try {

			if($request->hasFile('image')) {

				$file = $request->file('image');
				$input['imagename'] = md5(time()).'.'.$file->getClientOriginalExtension();
				$name_img = md5(time()).'.'.$file->getClientOriginalExtension();
				$destinationPath = public_path('storage/files/');
				$file->move($destinationPath, $input['imagename']);
				$request->merge(array(
					'logo' =>  $name_img,
				));
			}



			AdClients::find($id)->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-advertisers'));
	}


	public function destroy(Request $request, $id)
	{
		try {
			$advertisers = AdClients::find($id);

			if(empty($advertisers)) {
				abort(404);
			}

			$advertisers->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-advertisers'));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$advertisers = AdClients::find($id);

			if(empty($advertisers)) {
				abort(404);
			}

			if($action == "desativar"){
				$advertisers->update(['status' => '2']);
			}else if($action == "ativar"){
				$advertisers->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-advertisers'));
	}


}
