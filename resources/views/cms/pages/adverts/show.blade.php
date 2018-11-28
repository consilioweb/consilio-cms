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
						<li class="breadcrumb-item active" aria-current="page">Anuncios</li>
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
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-user" aria-hidden="true"></i></span>
									</div>
									{!!Form::select('ad_clients_id', $clients, null, ['placeholder' => "Selecione o Cliente", 'class' => 'form-control select2', "required" => "required"]) !!}	
								</div>
							</div>							
						</div>

						<hr>

						<div class="row">
							<div class="col-lg-12" style="margin-bottom: 12px;">
								<h4 class="card-title">Tipo do Anuncio</h4>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input select-type" data-type="file-type" id="archive" name="radio-stacked">
										<label class="custom-control-label" for="archive">Arquivo</label>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input select-type" data-type="google-type" id="google" name="radio-stacked">
										<label class="custom-control-label" for="google">Google Adsense</label>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">
										<input type="radio" class="custom-control-input select-type" data-type="code-type" id="code" name="radio-stacked">
										<label class="custom-control-label" for="code">Código</label>
									</div>
								</div>
							</div>
						</div>


						<div id="file-type" class="row type-div" style="display: none;">
							<div class="col-lg-12">
								<div class="border-preview-img">
									
									<div class="input-group mb-3">
										{!! Form::file('image', ['class' => 'form-control input-file', 'id' => 'photo_profile']) !!}
										<div id="image-holder">				 				
											@if(!empty($adverts->photo))
											<div class="btn-thumb">
												@if($adverts->photo != "default.jpg")
												<a style="margin-bottom: 7px;" href="{!!route('cms-adverts-photos',  array($adverts->adverts_id, "delete"))!!}" class="btn waves-effect waves-light btn-dark">
													<i class="icon-trash"></i> Excluir
												</a>
												@endif
											</div>
											{!!img($adverts->photo, 400, 400, true, true, array("class" => "cover"))!!}
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
									{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Link do banner ex: http://']) !!}
								</div>
							</div>
						</div>

						<div id="google-type" class="row type-div" style="display: none;">
							<div class="col-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fab fa-google" aria-hidden="true"></i></span>
									</div>
									{!! Form::textarea('email', null, ['class' => 'form-control', 'placeholder' => 'Cole seu código do Google aqui ', 'rows' => '3']) !!}
								</div>
							</div>
						</div>


						<div id="code-type" class="row type-div" style="display: none;">
							<div class="col-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-code" aria-hidden="true"></i></span>
									</div>
									{!! Form::textarea('email', null, ['class' => 'form-control', 'placeholder' => 'Cole seu código aqui ', 'rows' => '3']) !!}
								</div>
							</div>
						</div>

						<hr>


						<div class="row">
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-email" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email ', 'autocomplete' => 'off ']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-lock" aria-hidden="true"></i></span>
									</div>
									{!! Form::password('password_input', ['class' => 'form-control password-input', 'placeholder' => 'Senha ', 'autocomplete' => 'off ']) !!}
								</div>
							</div>							
						</div>
						
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-calendar" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('birth', null, ['class' => 'form-control datepicker']) !!}
								</div>
							</div>
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-energy" aria-hidden="true"></i></span>
									</div>
									{!!Form::select('type', ['1' => 'Administrador do Sitema',  '2' => 'Adminsitrador do Site',  '3' => 'Usuário do Site'], null, ['placeholder' => "Selecione", 'class' => 'form-control select2', "required" => "required"]) !!}	
								</div>
							</div>							
						</div>
						<button type="submit" class="btn btn-primary">Salvar</button>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection