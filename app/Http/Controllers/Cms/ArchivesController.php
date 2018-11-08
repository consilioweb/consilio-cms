<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;
use App\Model\Contents;
use App\Model\Gallery;



class ArchivesController extends CmsController
{

	public function index(Request $request, $modules_id, $contents_id)
	{


		$gallery 	= Gallery::where('contents_id', $contents_id)->where('modules_id', $modules_id)->orderBy("gallery_id", "DESC");

		$module 	= Modules::where('modules_id', $modules_id)->first();
		$content 	= Contents::where('contents_id', $contents_id)->first();




		return view("cms/pages/archives/index", array(
			"gallery" => $gallery->get(),
			"module" => $module,
			"content" => $content,
		));

	}

	public function show(Request $request, $modules_id, $contents_id)
	{

		$file_list = array();
		//$destinationPath = public_path('storage/files/');
		$caminho = public_path('storage/files/');

		$destinationPath = "/cms-default/public/storage/files/extensions/";

		$gallery 	= Gallery::where('type', '2')->where('contents_id', $contents_id)->where('modules_id', $modules_id)->orderBy("gallery_id", "DESC")->get();


		foreach ($gallery as $value) {
			$file_list[] = array('name'=>$value->file,'path'=>$destinationPath.$value->extension.'.png', 'size' => '0');
		}

		return response()->json($file_list);
	}

	public function remove(Request $request, $modules_id, $contents_id, $image)
	{

		try {
			$gallery = Gallery::where('contents_id', $contents_id)->where('modules_id', $modules_id)->where('file', $image)->first();

			if(empty($gallery)) {
				return response()->json(["return" => "error", "message" => "não encontado"]);
			}

			$destinationPath = public_path('storage/files/');

			if(file_exists($destinationPath.$image)){
				unlink($destinationPath.$image);
				$gallery->delete();
				return response()->json(["return" => "success", "message" => "excluido com sucesso!"]);
			}

		} catch (Exception $e) {
			return response()->json(["return" => "error", "message" => $e]);
		}

	}

	public function upload(Request $request, $modules_id, $contents_id)
	{
		try {

			$definitions = Definitions::first();
			$destinationPath = public_path('storage/files/');

			if($request->hasFile('file')){

				$filename = $request->file('file');

				$extBanco = $definitions->ext_files;
				$explodeExtencao = explode(',', $extBanco);
				$exOk = (array) $explodeExtencao;
				$allowedExts = $exOk;


				$w = 0;
				foreach ($filename as $file) {
					$ext = str_replace('.', '', strrchr($file->getClientOriginalName(), '.'));
					if (in_array($ext, $allowedExts)) {

						
						$new_name = md5(date("Y.m.d-h:i:s")) . $w . "." . $ext;
						$file->move($destinationPath, $new_name);

						Gallery::create([
							'modules_id' 		=> $modules_id,
							'contents_id' 		=> $contents_id,
							'file' 				=> $new_name,
							'type'				=> 2,
							'extension'			=> $ext,
							'status' 			=> 1
						]);

					}
					$w++;
				}

				return response()->json(["return" => "success", "message" => "Upload concluido"]);

			}else{
				return response()->json(["return" => "error", "message" => "Extensão não permetida"]);
			}

		} catch (Exception $e) {
			return response()->json(["return" => "error", "message" => $e]);
		}

	}

}