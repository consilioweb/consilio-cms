<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request; 

use App\Http\Requests;
use App\Model\Polls;
use App\Model\PollsQuestions;
use Excel;



class PollsController extends CmsController
{

	public function index(Request $request)
	{
		$polls = Polls::orderBy("polls_id", "DESC");

		if($request->input('title'))
		{
			$polls->where('title', 'like', '%'.$request->input('title').'%');
		}

		if($request->input('status'))
		{
			$polls->where('status', $request->input('status'));
		}


		return view("cms/pages/polls/index", array(
			"polls" => $polls->paginate(50),
		));
	}



	public function create()
	{
		return view("cms/pages/polls/show");
	}


	public function store(Request $request)
	{
		try { 
			$request->merge(array(
				'status' =>  '1',
				'show' =>  '1'
			));
			$polls = Polls::create($request->all());
			return redirect(route('cms-polls-show', $polls->polls_id)); 
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
			return redirect(route('cms-polls')); 
		}        
	}

	public function show($id)
	{   
		$polls = Polls::find($id);

		if (empty($polls)) {
			abort(404);
		}

		return view("cms/pages/polls/show", array(
			"polls" => $polls,
		));
	}


	public function update(Request $request, $id)
	{

		try {

			Polls::find($id)->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-polls'));
	}


	public function destroy(Request $request, $id)
	{
		try {
			$polls = Polls::find($id);

			if(empty($polls)) {
				abort(404);
			}

			$polls->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-polls'));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$polls = Polls::find($id);

			if(empty($polls)) {
				abort(404);
			}

			if($action == "desativar"){
				$polls->update(['status' => '2']);
			}else if($action == "ativar"){
				$polls->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-polls'));
	}

	public function exibhtion(Request $request, $id, $action)
	{

		try {
			$polls = Polls::find($id);

			if(empty($polls)) {
				abort(404);
			}

			if($action == "ocultar"){
				$polls->update(['show' => '2']);
			}else if($action == "exibir"){
				$polls->update(['show' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-polls'));
	}


}
