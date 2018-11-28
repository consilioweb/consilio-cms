<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;
use App\Model\Categories;


class CategoriesController extends CmsController
{

	public function index(Request $request)
	{
		$categories = Categories::orderBy("categories_id", "DESC");

		if($request->input('title'))
		{
			$categories->where('title', 'like', '%'.$request->input('title').'%');
		}

		if($request->input('status'))
		{
			$categories->where('status', $request->input('status'));
		}


		return view("cms/pages/categories/index", array(
			"categories" => $categories->paginate(50),
		));
	}


	public function create()
	{

		$Modules = Modules::where('status', '1')->get();

		return view("cms/pages/categories/show", array(
			"modules" => $Modules,
		));
	}


	public function store(Request $request)
	{


		$request->merge(array(
			'status' =>  '1'
		));

		try {
			$categories = Categories::create($request->all());
			return redirect(route('cms-categories-show', $categories->categories_id)); 
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
			return redirect(route('cms-categories')); 
		}        
	}


	public function show($id)
	{   
		$categories = Categories::find($id);

		if (empty($categories)) {
			abort(404);
		}


		$pages = Modules::where('status', '1')->get();
		$Modules = Modules::where('status', '1')->get();


		return view("cms/pages/categories/show", array(
			"categories" => $categories,
			"modules" => $Modules,
			"pages" => $pages,
		));
	}


	public function update(Request $request, $id)
	{

		try {

			Categories::find($id)->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-categories'));
	}


	public function destroy(Request $request, $id)
	{
		try {
			$categories = Categories::find($id);

			if(empty($categories)) {
				abort(404);
			}

			$categories->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-categories'));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$categories = Categories::find($id);

			if(empty($categories)) {
				abort(404);
			}

			if($action == "desativar"){
				$categories->update(['status' => '2']);
			}else if($action == "ativar"){
				$categories->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-categories'));
	}
}
