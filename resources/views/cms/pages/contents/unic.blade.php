@extends('cms.layouts._default')

@section('content')	


<div class="page-breadcrumb">
	<div class="row"> 
		<div class="col-5 align-self-center">
			<h4 class="page-title">{!!$module->module!!}</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!!$module->module!!} {!!(!isset($contents)) ? 'Novo' : 'Editar'!!}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<!-- Alerts -->
		@include('cms.layouts._alerts')

		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">{!!(!isset($contents)) ? 'Novo' : 'Editar'!!} {!!$module->module!!}</h4>
					@if(isset($contents))
					{!! Form::model($contents, ['route' => ['cms-contents-unic-update', $contents->contents_id], 'method' => 'put']) !!}
					@else
					{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-contents-unic-create', $module->modules_id]]) !!}
					@endif



					@if(!empty($module->check_1))
					<div class="form-group m-t-40 row">
						<span  class="col-2 "></span>
						<div class="col-10">
							<div class="custom-control custom-checkbox mr-sm-2">
								{!! Form::checkbox('check_1', '1', isset($contents->check_1) ? true : false, ['class' => 'custom-control-input', 'id' => 'check_1']) !!}
								{{-- <input type="checkbox" class="custom-control-input" id="check_1" value="check"> --}}
								<label class="custom-control-label" for="check_1">{!!$module->check_1!!}</label>
							</div>
						</div>
					</div>
					@endif
					
					@if(!empty($module->title))
					<div class="form-group row">
						<label for="title" class="col-2 col-form-label">{!!$module->title!!} </label>
						<div class="col-10">
							{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => $module->title, 'required' => 'required', 'id' => 'title']) !!}
						</div>
					</div>
					@endif
					
					@if(!empty($module->subtitle))
					<div class="form-group row">
						<label for="subtitle" class="col-2 col-form-label">{!!$module->subtitle!!} </label>
						<div class="col-10">
							{!! Form::text('subtitle', null, ['class' => 'form-control', 'placeholder' => $module->subtitle, 'required' => 'required', 'id' => 'subtitle']) !!}
						</div>
					</div>
					@endif
					
					
					@if(!empty($module->featured_image))
					<div class="form-group row">
						<label for="featured_image" class="col-2 col-form-label">{!!$module->featured_image!!} </label>
						<div class="col-10 border-preview-img">
							{!! Form::file('featured_image', ['class' => 'form-control input-file', 'id' => 'featured_image']) !!}
							<div id="image-holder">								
								@if(!empty($contents->featured_image))
								<div class="btn-thumb">
									<a href="{!!route('cms-contents-unic-delete-photo',  array($module->modules_id, $contents->contents_id))!!}">
										<i class="fa fa-times"></i> Apagar Imagem
									</a>
								</div>
								{!!img($contents->featured_image, 350, 200, true, true, array("class" => "cover"))!!}
								@endif
							</div> 
						</div>
					</div>
					@endif

					@if(!empty($module->summary))
					<div class="form-group row">
						<label for="summary" class="col-2 col-form-label">{!!$module->summary!!} </label>
						<div class="col-10">
							{!! Form::textarea('summary', null, ['class' => 'form-control', 'placeholder' => $module->summary, 'required' => 'required', 'id' => 'summary', 'rows' => '3']) !!}
						</div>
					</div>
					@endif

					@if(!empty($module->content))
					<div class="form-group row">
						<label for="content" class="col-2 col-form-label">{!!$module->content!!} </label>
						<div class="col-10">
							{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => $module->content, 'required' => 'required', 'id' => 'content', 'rows' => '12']) !!}
						</div>
					</div>
					@endif
					
					@if(!empty($module->credit_author))
					<div class="form-group row">
						<label for="credit_author" class="col-2 col-form-label">{!!$module->credit_author!!} </label>
						<div class="col-10">
							{!! Form::text('credit_author', null, ['class' => 'form-control', 'placeholder' => $module->credit_author, 'required' => 'required', 'id' => 'credit_author']) !!}
						</div>
					</div>
					@endif
					
					@if(!empty($module->tags))
					<div class="form-group row">
						<label for="tags" class="col-2 col-form-label">{!!$module->tags!!} </label>
						<div class="col-10">
							{!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => $module->tags, 'required' => 'required', 'id' => 'tags']) !!}
						</div>
					</div>
					@endif
					
					
					@if(!empty($module->tags))
					<div class="form-group row">
						<label for="tags" class="col-2 col-form-label">{!!$module->tags!!} </label>
						<div class="col-10">
							{!! Form::text('tags', null, ['class' => 'form-control', 'placeholder' => $module->tags, 'required' => 'required', 'id' => 'tags']) !!}
						</div>
					</div>
					@endif
					



					<button type="submit" class="btn btn-primary">Salvar</button>
					{!! Form::close() !!}   		 
				</div>
			</div>
		</div>
		
	</div>
</div>

<div class="container">

	<div class="row">
		<div class="col-lg-12">
			<div class="card ">
				<div class="card-header text-theme">
					<i class="fa fa-edit"></i>	{!!(!isset($contents)) ? 'Cadastrar' : 'Editar'!!} {!!$module->module!!}
				</div>
				<div class="card-body">
					@if(isset($contents))
					{!! Form::model($contents, ['route' => ['cms-contents-unic-update', $module->modules_id, $contents->contents_id], 'method' => 'put', "id" => "validation", "class" => "was-validated ", 'files' => true]) !!}
					@else
					{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-contents-unic-create', $module->modules_id] , "id" => "validation", "class" => "was-validated", 'files' => true]) !!}
					@endif   		    
					{{csrf_field()}} 

					@if(!empty(($module->initial_date) OR ($module->end_date)))			
					<div class="form-group row">
						@if(!empty($module->initial_date))
						<div class="col-md-6">
							<label class="form-control-label" for="prependedInput">{!!$module->initial_date!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">									
									<div class="input-group " >
										{!! Form::text('initial_date', null, ['class' => 'form-control datepicker', 'placeholder' => $module->initial_date]) !!}
										<div class="input-group-addon">
											<span class="mdi mdi-calendar"></span>
										</div>
									</div>
								</div>							
							</div>
						</div>
						@endif
						@if(!empty($module->end_date))
						<div class="col-md-6">
							<label class="form-control-label" for="prependedInput">{!!$module->end_date!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">						
									<div class="input-group">
										{!! Form::text('end_date', null, ['class' => 'form-control datepicker', 'placeholder' => $module->end_date]) !!}
										<div class="input-group-addon">
											<span class="mdi mdi-calendar"></span>
										</div>
									</div>
								</div>							
							</div>
						</div>
						@endif
					</div> 	
					@endif
					@if(!empty(($module->starting_time) OR ($module->starting_time)))			
					<div class="form-group row">

						@if(!empty($module->starting_time))
						<div class="col-md-6">
							<label class="form-control-label" for="prependedInput">{!!$module->starting_time!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">									
									<div class="input-group " >
										{!! Form::text('starting_time', null, ['class' => 'form-control clockpicker', 'placeholder' => $module->starting_time]) !!}
										<div class="input-group-addon">
											<span class="mdi mdi-timer"></span>
										</div>
									</div>
								</div>							
							</div>
						</div>
						@endif

						@if(!empty($module->end_time))
						<div class="col-md-6">
							<label class="form-control-label" for="prependedInput">{!!$module->end_time!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">						
									<div class="input-group">
										{!! Form::text('end_time', null, ['class' => 'form-control clockpicker', 'placeholder' => $module->end_time]) !!}
										<div class="input-group-addon">
											<span class="mdi mdi-timer"></span>
										</div>
									</div>
								</div>							
							</div>
						</div>
						@endif
					</div> 
					@endif
					@if(!empty($module->publication_date))

					<div class="form-group row">
						<div class="col-md-12">
							<label class="form-control-label" for="prependedInput">{!!$module->publication_date!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">									
									<div class="input-group " >
										<div class="input-group-addon">
											<span class="mdi mdi-calendar"></span>
										</div>
										{!! Form::text('publication_date', null, ['class' => 'form-control datepicker', 'placeholder' => $module->publication_date]) !!}
										
									</div>
								</div>							
							</div>
						</div>
					</div> 

					@endif
					@if(!empty($module->amount_1))
					<div class="form-group row">
						<div class="col-md-12">
							<label class="form-control-label" for="prependedInput">{!!$module->amount_1!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">
									<span class="input-group-addon"><i class="fa fa-file-o"></i></span>
									{!! Form::number('amount_1', null, ['class' => 'form-control', 'placeholder' => $module->amount_1]) !!}
								</div>							
							</div>
						</div>
					</div> 	
					@endif
					@if(!empty($module->amount_2))
					<div class="form-group row">
						<div class="col-md-12">
							<label class="form-control-label" for="prependedInput">{!!$module->amount_2!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">
									<span class="input-group-addon"><i class="fa fa-file-o"></i></span>
									{!! Form::number('amount_2', null, ['class' => 'form-control', 'placeholder' => $module->amount_2]) !!}
								</div>							
							</div>
						</div>
					</div> 	
					@endif
					@if(!empty($module->amount_3))
					<div class="form-group row">
						<div class="col-md-12">
							<label class="form-control-label" for="prependedInput">{!!$module->amount_3!!} </label>
							<div class="controls">
								<div class="input-prepend input-group">
									<span class="input-group-addon"><i class="fa fa-file-o"></i></span>
									{!! Form::number('amount_3', null, ['class' => 'form-control', 'placeholder' => $module->amount_3]) !!}
								</div>							
							</div>
						</div>
					</div> 

					@endif
					@if(!empty($module->check_3))

					<div class="form-group row" style="padding-top: 32px;">
						<div class="col-md-12">
							<div class="checkbox abc-checkbox">
								
								{!! Form::checkbox('check_3', '1', isset($contents->check_3) ? true : false, ['class' => 'styled', 'id' => 'check_3']) !!}
								<label for="check_3">
									{!!$module->check_3!!}
								</label>
							</div>
						</div>
					</div>
					@endif
					<div class="form-group row">
						<div class="col-md-12">
							<label class="form-control-label" for="prependedInput">Status </label>
							<div class="controls">
								<div class="input-prepend input-group">
									<span class="input-group-addon"><i class="fa fa-check"></i></span>
									{!!Form::select('status', ['1' => 'Ativo',  '2' => 'Inativo'], null, ['placeholder' => "Selecione", 'class' => 'form-control select2', "required" => "required"]) !!}	
								</div>							
							</div>
						</div>
					</div> 

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
					{!! Form::close() !!}
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->
		</div>
		<!--/.col-->
	</div>

</div>

@endsection 