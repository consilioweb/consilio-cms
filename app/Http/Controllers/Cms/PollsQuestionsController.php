<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request; 

use App\Http\Requests;
use App\Model\PollsQuestions;
use App\Model\Polls;



class PollsQuestionsController extends CmsController
{

	public function index(Request $request, $id)
	{
		$polls_questions = PollsQuestions::where('polls_id', $id)->orderBy("polls_questions_id", "DESC");
		$polls = Polls::where('polls_id', $id)->first();
		if($request->input('title'))
		{
			$polls_questions->where('title', 'like', '%'.$request->input('title').'%');
		}
		return view("cms/pages/polls-questions/index", array(
			"polls_questions" => $polls_questions->paginate(50),
			"poll" => $polls,
		));
	}



	public function create(Request $request, $id)
	{

		$poll = Polls::where('polls_id', $id)->first();
		return view("cms/pages/polls-questions/show", array(
			"polls" => $poll,
		));
	}


	public function store(Request $request)
	{
		try { 
			$request->merge(array(
				'status' =>  '1'
			));
			$polls_questions = PollsQuestions::create($request->all());
			return redirect(route('cms-polls-questions-show', array($polls_questions->polls_id, $polls_questions->polls_questions_id) )); 
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
			return redirect(route('cms-polls-questions')); 
		}        
	}

	public function show(Request $request, $polls_id, $polls_questions_id)
	{   


		$polls_questions = PollsQuestions::find($polls_questions_id);
		$poll = Polls::where('polls_id', $polls_id)->first();


		if (empty($polls_questions)) {
			abort(404);
		}

		return view("cms/pages/polls-questions/show", array(
			"polls_questions" => $polls_questions,
			"polls" => $poll,
		));
	}


	public function update(Request $request, $id)
	{

		try {

			PollsQuestions::find($id)->update($request->all());
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-polls-questions'));
	}


	public function destroy(Request $request, $polls_id, $polls_questions_id)
	{
		try {
			$polls_questions = PollsQuestions::find($polls_questions_id);

			if(empty($polls_questions)) {
				abort(404);
			}

			$polls_questions->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-polls-questions', $polls_id));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$polls_questions = PollsQuestions::find($id);

			if(empty($polls_questions)) {
				abort(404);
			}

			echo "algo";die;

			if($action == "desativar"){
				$polls_questions->update(['status' => '2']);
			}else if($action == "ativar"){
				$polls_questions->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-polls-questions'));
	}


}
