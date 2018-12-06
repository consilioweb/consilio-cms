<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request; 

use App\Http\Requests;
use App\Model\Newsletters;
use Excel;



class NewslettersController extends CmsController
{

	public function index(Request $request)
	{
		$newsletters = Newsletters::orderBy("newsletters_id", "DESC");

		if($request->input('email'))
		{
			$newsletters->where('email', 'like', '%'.$request->input('email').'%');
		}

		if($request->input('status'))
		{
			$newsletters->where('status', $request->input('status'));
		}


		return view("cms/pages/newsletters/index", array(
			"newsletters" => $newsletters->paginate(50),
		));
	}

	public function destroy(Request $request, $id)
	{
		try {
			$newsletters = Newsletters::find($id);

			if(empty($newsletters)) {
				abort(404);
			}

			$newsletters->delete();
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-newsletters'));
	}

	public function status(Request $request, $id, $action)
	{

		try {
			$newsletters = Newsletters::find($id);

			if(empty($newsletters)) {
				abort(404);
			}

			if($action == "desativar"){
				$newsletters->update(['status' => '2']);
			}else if($action == "ativar"){
				$newsletters->update(['status' => '1']);            
			}

			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}

		return redirect(route('cms-newsletters'));
	}

	public function report()
	{


		$newsletters = Newsletters::orderBy("newsletters_id", "DESC")->get();
		
		$data = $newsletters;

		Excel::create('Relatório de Newsletter '.date("d-m-Y H:i:s"), function($excel) use($data){
			$excel->setTitle('Relatório de Newsletter '.date("d-m-Y H:i:s"));
			$excel->setCreator('Agencia Consilio')->setCompany('Agencia Consilio');

			$schema_columns = array(
				'ID',
				'Nome',
				'E-mail',
				'Status',
				'Criado em:'
			);
			$excel->sheet('Relatório de Newsletter', function($sheet) use($schema_columns, $data) {
				$sheet->setOrientation('landscape');
				$sheet->setHeight(1, 30);
				$sheet->row(1,  $schema_columns);
				$sheet->cells('A1:E1', function($cells) {
					$cells->setBackground('#fa5838');
					$cells->setFontColor('#ffffff');
					$cells->setFontSize(12);
					$cells->setValignment('center');
					$cells->setAlignment('center');
				});
				foreach ($data as $key => $value)
				{                	
					$key += 2;
					$sheet->row($key, array(
						$value->newsletters_id,
						$value->name,
						$value->email,
						$value->status(),
						$value->created_at
					));
					$sheet->setHeight($key, 20);
				} 
			});

		})->export('xls');

	}


}
