<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;
use App\Model\Contents;
use App\Model\Gallery;
use App\Model\Definitions;

#

class GalleryController extends CmsController
{

	public function index(Request $request, $modules_id, $contents_id)
	{


		$gallery = Gallery::where('contents_id', $contents_id)->where('modules_id', $modules_id)->orderBy("gallery_id", "DESC");
		$total = $gallery->count();
		$module = Modules::where('modules_id', $modules_id)->first();
		$content = Contents::where('contents_id', $contents_id)->where('modules_id', $modules_id)->first();


		$pages = Modules::where('status', '1')->get();

		return view("cms/pages/gallery/index", array(
			"gallery" => $gallery->paginate(50),
			"module" => $module,
			"content" => $content,
			"total" => $total,
		));

	}

	public function upload(Request $request, $modules_id, $contents_id)
	{
		try {

			$definitions = Definitions::first();

			if($request->hasFile('images')){
				$files = $request->file('images');

				$extBanco = $definitions->ext_photos;
				$explodeExtencao = explode(',', $extBanco);
				$exOk = (array) $explodeExtencao;
				$allowedExts = $exOk;

				$destinationPath = public_path('storage/files/');

				$w=0;
				foreach ($files as $file) {


					$ext = str_replace('.', '', strrchr($file->getClientOriginalName(), '.'));

					if (in_array($ext, $allowedExts)) {

						$new_name = md5(date("Y.m.d-H.i.s") . "-" . $w) . "." . $ext;

						$file->move($destinationPath, $new_name);


					}else{
						$request->session()->flash('alert', array('code'=> 'danger', 'text'  => 'Extenção Não Permetida!'));
						return redirect(route('cms-gallery', array($modules_id ,$contents_id))); 
						die;
					}

					Gallery::create([
						'modules_id' 		=> $modules_id,
						'contents_id' 		=> $contents_id,
						'file' 				=> $new_name,
						'type'				=> $ext,
						'status' 			=> 1
					]);

					$w++;
				}
			}
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
			return redirect(route('cms-gallery', array($modules_id ,$contents_id))); 

		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}
		
	}

	public function status(Request $request, $modules_id, $contents_id, $gallery_id)
	{

		try {

			$gallery = Gallery::where('contents_id', $contents_id)
			->where('modules_id', $modules_id)
			->where("gallery_id", $gallery_id)
			->first();

			if($gallery->status == 1){
				$gallery->update(['status' => 2]);			
			}else{			
				$gallery->update(['status' => 1]);			
			}
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));

		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}
		
		return redirect(route('cms-gallery', array($modules_id ,$contents_id))); 

	}

	public function destroy(Request $request, $modules_id, $contents_id, $gallery_id)
	{
		try {

			$gallery = Gallery::where('contents_id', $contents_id)
			->where('modules_id', $modules_id)
			->where("gallery_id", $gallery_id)
			->first();



			$destinationPath = public_path('storage/files/');

			if(file_exists($destinationPath.$gallery->file)){
				unlink($destinationPath.$gallery->file);

				$gallery->delete();
			}
			$request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));

		} catch (Exception $e) {
			$request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
		}
		
		return redirect(route('cms-gallery', array($modules_id ,$contents_id))); 

	}

}