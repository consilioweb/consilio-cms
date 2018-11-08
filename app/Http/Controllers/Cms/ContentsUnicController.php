<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;
use App\Model\Contents;
use App\Model\Categories;
use App\Model\Definitions;
use Validator;



class ContentsUnicController extends CmsController
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request, $modules_id)
   {

    $contents   = Contents::where('modules_id', $modules_id)->orderBy("contents_id", "DESC");
    $module     = Modules::where('modules_id', $modules_id)->first();
    return view("cms/pages/contents/unic", array(
        "module"=> $module,
        "contents" => $contents->first(),
    ));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $modules_id)
    {

        $module     = Modules::where('modules_id', $modules_id)->first();

        if (empty($module)) {
            abort(404);
        }

        $validator = Validator::make($request->input(), [
            'title'  => 'required'
        ]);

        $niceNames = array(
            'title'  => 'titulo'
        );

        $validator->setAttributeNames($niceNames); 

        if($validator->fails()) {
            return redirect(route('cms-contents-unic', $module->modules_id))->withErrors($validator->messages())->withInput();        
        } 


        if($request->hasFile('image')) {

            $file = $request->file('image');
            $input['imagename'] = md5(time()).'.'.$file->getClientOriginalExtension();
            $name_img = md5(time()).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/files/');
            $file->move($destinationPath, $input['imagename']);
            $request->merge(array(
                'featured_image' =>  $name_img,
            ));
        }



        $request->merge(array(
            'modules_id' =>  $modules_id,
            'status' =>  '1',
        ));





        try {
            Contents::create(array_filter($request->all()));
            return redirect(route('cms-contents-unic', $module->modules_id)); 
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
            return redirect(route('cms-contents-unic', $module->modules_id)); 
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $modules_id) 
    {
        $validator = Validator::make($request->input(), [
            'title'       => 'required'

        ]);

        $niceNames = array(
            'title'       => 'titulo'
        );

        $validator->setAttributeNames($niceNames); 

        if($validator->fails()) {
            return redirect(route('cms-contents-unic', $module->modules_id))->withErrors($validator->messages())->withInput();        
        } 


        if($request->hasFile('image')) {

            $file = $request->file('image');
            $input['imagename'] = md5(time()).'.'.$file->getClientOriginalExtension();
            $name_img = md5(time()).'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('storage/files/');
            $file->move($destinationPath, $input['imagename']);
            $request->merge(array(
                'featured_image' =>  $name_img,
            ));
        }





        $request->merge(array(
            'modules_id' =>  $modules_id,
            'status' =>  '1',
        ));

        $results = $request->all();



        $checks = array();

        if(!$request->input('featured')){
            $checks['featured'] = null;
        }

        if(!$request->input('check_1')){
            $checks['check_1'] = null;
        }

        if(!$request->input('check_2')){
            $checks['check_2'] = null;
        }

        if(!$request->input('check_3')){
            $checks['check_3'] = null;
        }



        $results = array_merge($results, $checks);



        try {

            $contents   = Contents::where('modules_id', $modules_id)->orderBy("contents_id", "DESC")->first();

            $contents->update($results);

            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
        }

        return redirect(route('cms-contents-unic', $modules_id));
    }

    public function destroyPhoto(Request $request, $modules_id, $photo)
    {
        try {

            $contents = Contents::where('modules_id', $modules_id)->where('modules_id', $modules_id)->first();

            if(empty($contents)) {
                abort(404);
            }

            $destinationPath = public_path('storage/files/');

            if(file_exists($destinationPath.$contents->featured_image)){
                unlink($destinationPath.$contents->featured_image);
                $contents->update(['featured_image' => NULL]);
            }



            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
        }

        return redirect(route('cms-contents-unic', $modules_id)); 
    }
}
