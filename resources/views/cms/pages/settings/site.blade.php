@extends('cms.layouts._default')

@section('content')	


<!-- Breadcrumb -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Configurações do Site</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Configurações</li>
						<li class="breadcrumb-item active" aria-current="page">Site</li>
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
					<h4 class="card-title">Configuraçoes do Site</h4>
					<h6 class="card-subtitle"> Todas as configurações de SEO e tags de Busca</h6>
					
					<div class="col-sm-12 col-xs-12">

						{!! Form::model($site, ['route' => ['cms-settings-site-update'], 'method' => 'put']) !!}


						{{csrf_field()}}
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1"><i class="fa fa-pencil-square-o"></i></span>
							</div>
							{!! Form::text('title', null,  ['class' => 'form-control', 'placeholder' => 'Titulo do Site' ]) !!}
						</div>
						<div class="input-group mb-3">
							{!! Form::textarea('description', null,  ['class' => 'form-control', 'placeholder' => 'Descricao do Site', 'rows' => '5' ]) !!}
						</div>
						<div class="input-group mb-3">					
							{!! Form::textarea('keywords', null,  ['class' => 'form-control', 'placeholder' => 'Palavras Chaves', 'rows' => '5' ]) !!}
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('email', null,  ['class' => 'form-control', 'placeholder' => 'Email do Sistema' ]) !!}
								</div>
							</div>
							<div class="col-lg-6">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('password_email', null,  ['class' => 'form-control', 'placeholder' => 'Senha do Email' ]) !!}
								</div>
							</div>							
						</div>

						<div class="row">
							
							<div class="col-md-3">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-phone" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('phone', null,  ['class' => 'form-control', 'placeholder' => 'Telefone' ]) !!}
								</div>
							</div>
							
							<div class="col-md-5">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-home" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('address', null,  ['class' => 'form-control', 'placeholder' => 'Endereço' ]) !!}
								</div>
							</div>
							
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-bookmark" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('district', null,  ['class' => 'form-control', 'placeholder' => 'Bairro' ]) !!}
								</div>
							</div>

						</div>

						<div class="row">
							
							<div class="col-md-4">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-pin" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('zip_code', null,  ['class' => 'form-control', 'placeholder' => 'CEP' ]) !!}
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">
									<select id="state_select" name="states_id" class="form-control select2" data-plugin="select2" style="width: 100%;">			
										@foreach($states as $value)								
										<option value="{!!$value->states_id!!}" @if($site->states_id == $value->states_id) selected="selected" @endif >
											{!!$value->name!!}
										</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group mb-3">

									@if($site->cities_id == "")
									<select id="cities_select" name="cities_id" class="form-control select2" data-plugin="select2" style="width: 100%;">			
										<option selected="selected" disabled="disabled">Selecione um Estado</option>
									</select>
									@else

									<select id="cities_select" name="cities_id" class="form-control select2" data-plugin="select2" style="width: 100%;">	
										@foreach($cities as $value)		
										<option value="{!!$value->cities_id!!}" @if($site->cities_id == $value->cities_id) selected="selected" @endif >
											{!!$value->name!!}
										</option>
										@endforeach
									</select>										
									@endif

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


	@endsection