@extends('cms.layouts._default')
@section('content')	

<!-- Breadcrumb --> 
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Módulos de Banners</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">
							<a href="{!!route('cms-adverts-locations')!!}">Módulos / Locais</a>
						</li>					
						<li class="breadcrumb-item active" aria-current="page">{!!(!isset($adverts_locations)) ? 'Novo' : 'Editar'!!}</li>
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
					<h4 class="card-title">Cadastro de Módulos / Locais</h4>
					
					<div class="col-sm-12 col-xs-12">

						@if(isset($adverts_locations))
						{!! Form::model($adverts_locations, ['route' => ['cms-adverts-locations-update', $adverts_locations->ad_locations_id], 'method' => 'put', 'files' => true]) !!}
						@else
						{!! Form::open(['method' => 'post', 'autocomplete' => 'off', 'route' => ['cms-adverts-locations-create'], 'files' => true]) !!}
						@endif  

						<div class="row">
							<div class="col-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="icon-pencil" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Titulo']) !!}
								</div>
							</div>						
						</div>
						<div class="row">
							<div class="col-12">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="ti-ruler-alt" aria-hidden="true"></i></span>
									</div>
									{!! Form::text('size', null, ['class' => 'form-control', 'placeholder' => 'Tamanho (000/000)']) !!}
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