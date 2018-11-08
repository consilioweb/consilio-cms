<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Modules;



class ModulesController extends CmsController
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
   {
    $modules = Modules::orderBy("modules_id", "DESC");

    if($request->input('module'))
    {
       $modules->where('module', 'like', '%'.$request->input('module').'%');
   }

   if($request->input('status'))
   {
       $modules->where('status', $request->input('status'));
   }


   $pages = Modules::where('status', '1')->get();


   return view("cms/pages/modules/index", array(
    "modules" => $modules->paginate(50),
    "pages" => $pages,
));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


       $pages = Modules::where('status', '1')->get();

       return view("cms/pages/modules/show", array(

            "pages" => $pages,
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

        
        if($request->input('title-checkbox') != 1){
            $request->merge(array(
                'title' =>  null
            ));
        }

        if($request->input('subtitle-checkbox') != 1){
            $request->merge(array(
                'subtitle' =>  null
            ));
        }

        if($request->input('featured-checkbox') != 1){
            $request->merge(array(
                'featured' =>  null
            ));
        }

        if($request->input('category-checkbox') != 1){
            $request->merge(array(
                'category' =>  null
            ));
        }

        if($request->input('featured_image-checkbox') != 1){
            $request->merge(array(
                'featured_image' =>  null
            ));
        }

        if($request->input('summary-checkbox') != 1){
            $request->merge(array(
                'summary' =>  null
            ));
        }

        if($request->input('content-checkbox') != 1){
            $request->merge(array(
                'content' =>  null
            ));
        }

        if($request->input('credit_author-checkbox') != 1){
            $request->merge(array(
                'credit_author' =>  null
            ));
        }

        if($request->input('tags-checkbox') != 1){
            $request->merge(array(
                'tags' =>  null
            ));
        }

        if($request->input('initial_date-checkbox') != 1){
            $request->merge(array(
                'initial_date' =>  null
            ));
        }

        if($request->input('end_date-checkbox') != 1){
            $request->merge(array(
                'end_date' =>  null
            ));
        }

        if($request->input('starting_time-checkbox') != 1){
            $request->merge(array(
                'starting_time' =>  null
            ));
        }

        if($request->input('end_time-checkbox') != 1){
            $request->merge(array(
                'end_time' =>  null
            ));
        }

        if($request->input('publication_date-checkbox') != 1){
            $request->merge(array(
                'publication_date' =>  null
            ));
        }

        if($request->input('amount_1-checkbox') != 1){
            $request->merge(array(
                'amount_1' =>  null
            ));
        }

        if($request->input('amount_2-checkbox') != 1){
            $request->merge(array(
                'amount_2' =>  null
            ));
        }

        if($request->input('amount_3-checkbox') != 1){
            $request->merge(array(
                'amount_3' =>  null
            ));
        }

        if($request->input('check_1-checkbox') != 1){
            $request->merge(array(
                'check_1' =>  null
            ));
        }

        if($request->input('check_2-checkbox') != 1){
            $request->merge(array(
                'check_2' =>  null
            ));
        }

        if($request->input('check_3-checkbox') != 1){
            $request->merge(array(
                'check_3' =>  null
            ));
        }




        if($request->input('external_link') != 1){
            $request->merge(array(
                'external_link' =>  null
            ));
        }

        if($request->input('optimization_seo') != 1){
            $request->merge(array(
                'optimization_seo' =>  null
            ));
        }

        if($request->input('image_gallery') != 1){
            $request->merge(array(
                'image_gallery' =>  null
            ));
        }

        if($request->input('video_gallery') != 1){
            $request->merge(array(
                'video_gallery' =>  null
            ));
        }

        if($request->input('file_gallery') != 1){
            $request->merge(array(
                'file_gallery' =>  null
            ));
        }


        $request->merge(array(
            'status' =>  '1'
        ));

        try {
            $modules = Modules::create($request->all());
            return redirect(route('cms-modules-show', $modules->modules_id)); 
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
            return redirect(route('cms-modules')); 
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $modules = Modules::find($id);

        if (empty($modules)) {
            abort(404);
        }
        $pages = Modules::where('status', '1')->get();

        return view("cms/pages/modules/show", array(
            "modules" => $modules,
            "pages" => $pages,
        ));
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


        if($request->input('title-checkbox') != 1){
            $request->merge(array(
                'title' =>  null
            ));
        }

        if($request->input('subtitle-checkbox') != 1){
            $request->merge(array(
                'subtitle' =>  null
            ));
        }

        if($request->input('featured-checkbox') != 1){
            $request->merge(array(
                'featured' =>  null
            ));
        }

        if($request->input('category-checkbox') != 1){
            $request->merge(array(
                'category' =>  null
            ));
        }

        if($request->input('featured_image-checkbox') != 1){
            $request->merge(array(
                'featured_image' =>  null
            ));
        }

        if($request->input('summary-checkbox') != 1){
            $request->merge(array(
                'summary' =>  null
            ));
        }

        if($request->input('content-checkbox') != 1){
            $request->merge(array(
                'content' =>  null
            ));
        }

        if($request->input('credit_author-checkbox') != 1){
            $request->merge(array(
                'credit_author' =>  null
            ));
        }

        if($request->input('tags-checkbox') != 1){
            $request->merge(array(
                'tags' =>  null
            ));
        }

        if($request->input('initial_date-checkbox') != 1){
            $request->merge(array(
                'initial_date' =>  null
            ));
        }

        if($request->input('end_date-checkbox') != 1){
            $request->merge(array(
                'end_date' =>  null
            ));
        }

        if($request->input('starting_time-checkbox') != 1){
            $request->merge(array(
                'starting_time' =>  null
            ));
        }

        if($request->input('end_time-checkbox') != 1){
            $request->merge(array(
                'end_time' =>  null
            ));
        }

        if($request->input('publication_date-checkbox') != 1){
            $request->merge(array(
                'publication_date' =>  null
            ));
        }

        if($request->input('amount_1-checkbox') != 1){
            $request->merge(array(
                'amount_1' =>  null
            ));
        }

        if($request->input('amount_2-checkbox') != 1){
            $request->merge(array(
                'amount_2' =>  null
            ));
        }

        if($request->input('amount_3-checkbox') != 1){
            $request->merge(array(
                'amount_3' =>  null
            ));
        }

        if($request->input('check_1-checkbox') != 1){
            $request->merge(array(
                'check_1' =>  null
            ));
        }

        if($request->input('check_2-checkbox') != 1){
            $request->merge(array(
                'check_2' =>  null
            ));
        }

        if($request->input('check_3-checkbox') != 1){
            $request->merge(array(
                'check_3' =>  null
            ));
        }




        if($request->input('external_link') != 1){
            $request->merge(array(
                'external_link' =>  null
            ));
        }

        if($request->input('optimization_seo') != 1){
            $request->merge(array(
                'optimization_seo' =>  null
            ));
        }

        if($request->input('image_gallery') != 1){
            $request->merge(array(
                'image_gallery' =>  null
            ));
        }

        if($request->input('video_gallery') != 1){
            $request->merge(array(
                'video_gallery' =>  null
            ));
        }

        if($request->input('file_gallery') != 1){
            $request->merge(array(
                'file_gallery' =>  null
            ));
        }


        try {

            Modules::find($id)->update($request->all());
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
        }

        return redirect(route('cms-modules'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $modules = Modules::find($id);

            if(empty($modules)) {
                abort(404);
            }

            $modules->delete();
            $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
        } catch (Exception $e) {
            $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
        }

        return redirect(route('cms-modules'));
    }

    public function status(Request $request, $id, $action)
    {

       try {
        $modules = Modules::find($id);

        if(empty($modules)) {
            abort(404);
        }

        if($action == "desativar"){
            $modules->update(['status' => '2']);
        }else if($action == "ativar"){
            $modules->update(['status' => '1']);            
        }

        $request->session()->flash('alert', array('code'=> 'success', 'text'  => 'Operação realizada com sucesso!'));
    } catch (Exception $e) {
        $request->session()->flash('alert', array('code'=> 'error', 'text'  => $e));
    }

    return redirect(route('cms-modules'));
}
}
