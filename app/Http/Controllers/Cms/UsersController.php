<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Users;
use App\Model\Modules;

use Auth;

use App\Model\Sessions;


class usersController extends CmsController
{

	public function index(Request $request)
	{		

		$users = Users::orderBy("users_id", "DESC");

		if($request->input('name'))
		{
			$users->where('name', 'like', '%'.$request->input('name').'%');
		}

		if($request->input('status'))
		{
			$users->where('status', $request->input('status'));
		}


		$pages = Modules::where('status', '1')->get();


		return view("cms/pages/users/index", array(
			"users" => $users->paginate(50),
			"pages" => $pages,
		));
	}


	public function create()
	{


		$pages = Modules::where('status', '1')->get();

		return view("cms/pages/users/show", array(
			"pages" => $pages,
		));
	}


	public function store(Request $request)
	{ 

		try {

			if($request->input('type') == '1'){
				if(Auth::user()->type != '1'){					
					$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Você não tem permissão'));
					return redirect(route('cms-users')); 
				}
			}

			if($request->input('password_input')){			
				$request->merge(array( 
					'password' =>  $request->input('password_input')
				));
			}
			

			if($request->hasFile('image')) {

				$file = $request->file('image');
				$input['imagename'] = md5(time()).'.'.$file->getClientOriginalExtension();
				$name_img = md5(time()).'.'.$file->getClientOriginalExtension();
				$destinationPath = public_path('storage/files/');
				$file->move($destinationPath, $input['imagename']);
				$request->merge(array(
					'photo' =>  $name_img,
				));
			}

			$request->merge(array( 
				'status' =>  '1'
			));

			$users = Users::create($request->all());
			return redirect(route('cms-users-show', $users->users_id)); 
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
			return redirect(route('cms-users')); 
		}        
	}


	public function show(Request $request, $id)
	{   
		$users = Users::find($id);


		if($users->type == '1'){
			if(Auth::user()->type != '1'){					
				$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Você não tem permissão'));
				return redirect(route('cms-users')); 
			}
		}

		if (empty($users)) {
			abort(404);
		}


		$pages = Modules::where('status', '1')->get();
		$Modules = Modules::where('status', '1')->get();


		return view("cms/pages/users/show", array(
			"users" => $users,
			"modules" => $Modules,
			"pages" => $pages,
		));
	}


	public function update(Request $request, $id)
	{

		try {


			if($request->input('type') == '1'){
				if(Auth::user()->type != '1'){					
					$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Você não tem permissão'));
					return redirect(route('cms-users')); 
				}
			}

			if($request->input('password_input')){			

				$request->merge(array( 
					'password' =>  $request->input('password_input')
				));
			}

			if($request->hasFile('image')) {

				$file = $request->file('image');
				$input['imagename'] = md5(time()).'.'.$file->getClientOriginalExtension();
				$name_img = md5(time()).'.'.$file->getClientOriginalExtension();
				$destinationPath = public_path('storage/files/');
				$file->move($destinationPath, $input['imagename']);
				$request->merge(array(
					'photo' =>  $name_img,
				));
			}


			Users::find($id)->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-users'));
	}


	public function destroy(Request $request, $id)
	{
		try {
			$users = Users::find($id);



			if($users->type == '1'){
				if(Auth::user()->type != '1'){					
					$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Você não tem permissão'));
					return redirect(route('cms-users')); 
				}
			}

			if(empty($users)) {
				abort(404);
			}

			$users->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-users'));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$users = Users::find($id);

			

			if($users->type == '1'){
				if(Auth::user()->type != '1'){					
					$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Você não tem permissão'));
					return redirect(route('cms-users')); 
				}
			}

			if(empty($users)) {
				abort(404);
			}

			if($action == "desativar"){
				$users->update(['status' => '2']);
			}else if($action == "ativar"){
				$users->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-users'));
	}

	public function destroyPhoto(Request $request, $users_id, $action)
	{
		try {

			$destinationPath = public_path('storage/files/');

			if(Auth::user()->type != '1'){
				$users = Users::where('users_id', $users_id)->first();				

				if(empty($users)) {
					abort(404);
				}

				if(Auth::user()->users_id != $users->users_id){
					$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Você não tem permissão'));
				}else{
					if(file_exists($destinationPath.$users->photo)){
						unlink($destinationPath.$users->photo);
					}else{
						$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Arquivo Não Encontrado'));	
					}
					$users->photo = 'default.jpg';
					$users->save();
				}
			}else{

				$users = Users::where('users_id', $users_id)->first();		

				if(empty($users)) {
					abort(404);
				}

				if(file_exists($destinationPath.$users->photo)){
					unlink($destinationPath.$users->photo);
				}else{
					$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Arquivo Não Encontrado'));
					
				}
				$users->photo = 'default.jpg';
				$users->save();
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-users')); 
	}
}
