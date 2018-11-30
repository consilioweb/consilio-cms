@extends('cms.layouts._default')
@section('content')	

<!-- Breadcrumb -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Anunciantes</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							<a href="{!!route('cms-advertisers')!!}">Anunciantes</a>
						</li>					
						<li class="breadcrumb-item active" aria-current="page">{!!(!isset($advertisers)) ? 'Novo' : 'Editar'!!}</li>
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
					<h4 class="card-title">Cadastro de Anunciantes</h4>
					
					<div class="col-sm-12 col-xs-12">

						@if(isset($advertisers))
						{!! Form::model($advertisers, ['route' => ['cms-advertisers-update', $advertisers->ad_clients_id], 'method' => 'put', 'files' => true]) !!}
						@else
						{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-advertisers-create'], 'files' => true]) !!}
						@endif  

						<div class="row">
							<div class="col-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-pencil" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo/Apelido ']) !!}
								</div>
							</div>						
						</div>

						<div class="row">
							<div class="col-lg-12">
								<div class="border-preview-img">
									
									<div class="input-group mb-3">
										{!! Form::file('image', ['class' => 'form-control input-file', 'id' => 'photo_profile']) !!}
										<div id="image-holder">				 				
											@if(!empty($advertisers->logo))												

											{!!img($advertisers->logo, true)!!}

											@endif
										</div>  
									</div>
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-lg-12" style="margin-bottom: 12px;">
								<h4 class="card-title">Prioridade do Anunciante</h4>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">										
										{!! Form::radio('priority', '3', isset($adverts->priority) ? $adverts->priority == 3 : null, ['class' => 'custom-control-input ', 'required' => 'required', 'id' => 'alta']) !!}
										<label class="custom-control-label" for="alta">Alta</label>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">
										{!! Form::radio('priority', '2', isset($adverts->priority) ? $adverts->priority == 2 : null, ['class' => 'custom-control-input', 'required' => 'required', 'id' => 'media']) !!}
										<label class="custom-control-label" for="media">Média</label>
									</div>
								</div>
								<div class="form-check form-check-inline">
									<div class="custom-control custom-radio">
										{!! Form::radio('priority', '1', isset($adverts->priority) ? $adverts->priority == 1 : null, ['class' => 'custom-control-input', 'required' => 'required', 'id' => 'Baixa']) !!}
										<label class="custom-control-label" for="Baixa">Baixa</label>
									</div>
								</div>
							</div>
						</div>

						
						<hr>

						<div class="row">
							<div class="col-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class=" ti-shield" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('cnpj', null, ['class' => 'form-control cpfcnpj-mask', 'placeholder' => 'CPF/CNPJ', 'autocomplete' => 'off ']) !!}
								</div>
							</div>		
							<div class="col-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fas fa-phone" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('phone', null, ['class' => 'form-control phone-mask', 'placeholder' => 'Telefone', 'autocomplete' => 'off ']) !!}
								</div>
							</div>		
							<div class="col-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="far fa-envelope" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('email', null, ['class' => 'form-control ', 'placeholder' => 'Email', 'autocomplete' => 'off ']) !!}
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