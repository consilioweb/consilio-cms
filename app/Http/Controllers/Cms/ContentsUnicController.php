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
            "pages_unic" => Modules::where('type_module', '1')->where('status', '1')->get(),
            "pages_list" => Modules::where('type_module', '2')->where('status', '1')->get(),
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->input(), [
            'title'  => 'required'
        ]);

        $niceNames = array(
            'title'  => 'titulo'
        );

        $validator->setAttributeNames($niceNames); 

        if($validator->fails()) {
            return redirect(route('cms-contents'))->withErrors($validator->messages())->withInput();        
        } 

        try {
            Contents::create(array_filter($request->all()));
            return redirect(route('cms-contents')); 
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
            return redirect(route('cms-contents')); 
        }        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), [
            'title'       => 'required'

        ]);

        $niceNames = array(
            'title'       => 'titulo'
        );

        $validator->setAttributeNames($niceNames); 

        if($validator->fails()) {
            return redirect(route('cms-contents'))->withErrors($validator->messages())->withInput();        
        } 

        try {
           
            Contents::find($id)->update($request->except("image"));
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
        }
       
        return redirect(route('cms-contents'));
    }
}
