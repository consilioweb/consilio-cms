@extends('cms.layouts._default')
@section('content')	

<!-- Breadcrumb -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Banners</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							<a href="{!!route('cms-adverts')!!}">Anuncios</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Banners</li>						
						<li class="breadcrumb-item active" aria-current="page">{!!(!isset($adverts)) ? 'Novo' : 'Editar'!!}</li>
					</ol>
				</nav>
			</div>
		</div>
	</div> 
</div>


<div class="container-fluid">
	<div class="row">		
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Cadastro de Banner</h4>
					
					<div class="col-sm-12 col-xs-12">

						@if(isset($adverts))
						{!! Form::model($adverts, ['route' => ['cms-adverts-update', $adverts->adverts_id], 'method' => 'put', 'files' => true]) !!}
						@else
						{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-adverts-create'], 'files' => true]) !!}
						@endif  

						<div class="row">
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-pencil" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo/Apelido ']) !!}
								</div>
							</div>
							<div class="col-lg-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user" aria-hidden="true"></i></span>
									</div>
									{!!Form::select('ad_clients_id', $clients, null, ['placeholder' => "Selecione o Cliente", 'class' => 'form-control ', "required" => "required"]) !!}	
								</div>
							</div>	
							<div class="col-lg-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user" aria-hidden="true"></i></span>
									</div>
									{!!Form::select('ad_locations_id', $locations, null, ['placeholder' => "Selecione o Local", 'class' => 'form-control ', "required" => "required"]) !!}	
								</div>
							</div>							
						</div>

						<hr>



						<div class="row">
							<div class="col-lg-12" style="margin-bottom: 12px;">
								<h4 class="card-title">Tipo do Anuncio</h4>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">										
										{!! Form::radio('type', '1', isset($adverts->type) ? $adverts->type == 1 : null, ['class' => 'custom-control-input select-type', 'required' => 'required', 'id' => 'archive', 'data-type' => 'file-type']) !!}
										<label class="custom-control-label" for="archive">Arquivo</label>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">
										{!! Form::radio('type', '2', isset($adverts->type) ? $adverts->type == 2 : null, ['class' => 'custom-control-input select-type', 'required' => 'required', 'id' => 'google', 'data-type' => 'google-type']) !!}
										<label class="custom-control-label" for="google">Google Adsense</label>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">
										{!! Form::radio('type', '3', isset($adverts->type) ? $adverts->type == 3 : null, ['class' => 'custom-control-input select-type', 'required' => 'required', 'id' => 'code', 'data-type' => 'code-type']) !!}
										<label class="custom-control-label" for="code">Código</label>
									</div>
								</div>
							</div>
						</div>


						<div id="file-type" class="row type-div" {!!isset($adverts) ? ($adverts->type == '1') ? ' style="display:block" ' : ' style="display:none" ' : ' style="display: none;" ' !!} >
							<div class="col-lg-12">
								<div class="border-preview-img">
									
									<div class="input-group mb-3">
										{!! Form::file('image', ['class' => 'form-control input-file', 'id' => 'photo_profile']) !!}
										<div id="image-holder">				 				
											@if(!empty($adverts->file))												
											@php 
											$ext = str_replace('.', '', strrchr($adverts->file, '.'));

											$size = explode("/", $adverts->location->size);

											@endphp

											@if($ext == 'swf')

												<object width="{!!$size[0]!!}" height="{!!$size[1]!!}">
													<param name="movie" value="{!!url("/") . '/public/storage/files/' . $adverts->file!!}">
													<embed src="{!!url("/") . '/public/storage/files/' . $adverts->file!!}" width="{!!$size[0]!!}" height="{!!$size[1]!!}">
													</embed>
												</object>

												@else
												{!!img($adverts->file, 400, 400, true, true, array("class" => "cover"))!!}
												@endif
												@endif
											</div>  
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-external-link-alt" aria-hidden="true"></i></span>
										</div>
										{!! Form::text('url', null, ['class' => 'form-control', 'placeholder' => 'Link do banner ex: http://']) !!}
									</div>
								</div>
							</div>

							<div id="google-type" class="row type-div" {!!isset($adverts) ? ($adverts->type == '2') ? ' style="display:block" ' : ' style="display:none" ' : ' style="display: none;" ' !!} >
								<div class="col-12">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fab fa-google" aria-hidden="true"></i></span>
										</div>
										{!! Form::textarea('code', null, ['class' => 'form-control', 'placeholder' => 'Cole seu código do Google aqui ', 'rows' => '3']) !!}
									</div>
								</div>
							</div>


							<div id="code-type" class="row type-div" {!!isset($adverts) ? ($adverts->type == '3') ? ' style="display:block" ' : ' style="display:none" ' : ' style="display: none;" ' !!} >
								<div class="col-12">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="fas fa-code" aria-hidden="true"></i></span>
										</div>
										{!! Form::textarea('code', null, ['class' => 'form-control', 'placeholder' => 'Cole seu código aqui ', 'rows' => '3']) !!}
									</div>
								</div>
							</div>

							<hr>


							<div class="row">
								<div class="col-12">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="ti-money" aria-hidden="true"></i></span>
										</div>
										{!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => 'Preço ', 'autocomplete' => 'off ']) !!}
									</div>
								</div>						
							</div>


							<div class="row">
								<div class="col-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="ti-calendar" aria-hidden="true"></i></span>
										</div>
										{!! Form::text('start_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Data Inicio', 'autocomplete' => 'off ']) !!}
									</div>
								</div>		
								<div class="col-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="ti-calendar" aria-hidden="true"></i></span>
										</div>
										{!! Form::text('end_date', null, ['class' => 'form-control datepicker', 'placeholder' => 'Data Fim', 'autocomplete' => 'off ']) !!}
									</div>
								</div>					
							</div>

							@if(isset($adverts))
							<div class="row">
								<div class="col-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="ti-mouse-alt" aria-hidden="true"></i></span>
										</div>
										{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Clicks ', 'disabled' => true]) !!}
									</div>
								</div>	
								<div class="col-6">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1"><i class="icon-eye" aria-hidden="true"></i></span>
										</div>
										{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Visualizações ', 'disabled' => true]) !!}
									</div>
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
	</div>



	@endsection