<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;
use App\Model\Contents;
use App\Model\Categories;
use App\Model\Definitions;


class ContentsListController extends CmsController
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request, $modules_id)
   {


    $contents = Contents::where('modules_id', $modules_id)->orderBy("contents_id", "DESC");

    if (empty($contents)) {
        abort(404);
    }
    $module = Modules::where('modules_id', $modules_id)->first();


    if($request->input('title'))
    {
       $contents->where('title', 'like', '%'.$request->input('title').'%');
   }

   if($request->input('status'))
   {
       $contents->where('status', $request->input('status'));
   }


   $modules = Modules::where('status', '1')->get();

   return view("cms/pages/contents/list", array(
    "contents" => $contents->paginate(25),
    "module" => $module,
));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $modules_id)
    {
       $modules = Modules::where('status', '1')->get();
       $module = Modules::where('modules_id', $modules_id)->first();
       $categories = Categories::where('status', '1')->where('modules_id', $modules_id)->get();

       return view("cms/pages/contents/show", array(
        "module" => $module,
        "categories" => $categories,
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
        ));


        try {
            $contents = Contents::create($request->all());
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => "Registro Cadastrado com sucesso!"));
            return redirect(route('cms-contents-list-show', array($modules_id ,$contents->contents_id))); 
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
            return redirect(route('cms-contents-list-show', array($modules_id ,$contents->contents_id))); 
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,  $modules_id, $contents_id)
    {   

       $modules = Modules::where('status', '1')->get();
       $module = Modules::where('modules_id', $modules_id)->first();
       $categories = Categories::where('status', '1')->where('modules_id', $modules_id)->get();

       $contents = Contents::find($contents_id);

       if (empty($contents)) {
        abort(404);
    }

    return view("cms/pages/contents/show", array(
        "contents" => $contents,
        "module" => $module,
        "categories" => $categories,
    ));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $modules_id, $contents_id)
    {

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

        $initial_date = $request->input('initial_date');
        $end_date = $request->input('end_date');
        $publication_date = $request->input('publication_date');

        $results = $request->all();

        unset($results['image']);
        unset($results['_method']);
        unset($results['_token']);
        unset($results['initial_date']);
        unset($results['end_date']);
        unset($results['publication_date']);


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


        $includes = array(
            'initial_date' =>  setDate($initial_date),
            'end_date' =>  setDate($end_date),
            'publication_date' =>  setDate($publication_date),
        );

        $results = array_merge($results, $includes, $checks);


        try {
            $contents = Contents::where('modules_id', $modules_id)->where('contents_id', $contents_id);
            $contents->update($results);
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
        }

        return redirect(route('cms-contents-list', $modules_id )); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $modules_id, $contents_id)
    {
        try {
            $contents = Contents::where('contents_id', $contents_id)->where('modules_id', $modules_id);

            if(empty($contents)) {
                abort(404);
            }

            $contents->delete();
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
        }

        return redirect(route('cms-contents-list', $modules_id));
    }

    public function destroyPhoto(Request $request, $modules_id, $contents_id)
    {
        try {
            $contents = Contents::where('contents_id', $contents_id)->where('modules_id', $modules_id)->first();

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

        return redirect(route('cms-contents-list-show', array($modules_id ,$contents->contents_id))); 
    }

    public function status(Request $request, $modules_id, $contents_id, $action)
    {

       try {
        $contents = Contents::where('contents_id', $contents_id)->where('modules_id', $modules_id)->first();

        if(empty($contents)) {
            abort(404);
        }

        if($action == "desativar"){
            $contents->update(['status' => '2']);
        }else if($action == "ativar"){
            $contents->update(['status' => '1']);            
        }

        $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
    } catch (Exception $e) {
        $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
    }

    return redirect(route('cms-contents-list', $modules_id));
}
}
