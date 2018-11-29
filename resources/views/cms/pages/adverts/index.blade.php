@extends('cms.layouts._default')
@section('content')


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
					</ol>
				</nav>
			</div>
		</div>
	</div> 
</div>


<div class="container-fluid">
	<!-- Alerts -->
	@include('cms.layouts._alerts')

	<div class="row">
		<div class="col-md-12">

			<div class="card">
				<div class="card-body">
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-modules']]) !!}
					<div class="row">

						<div class="form-group col-sm-6">
							{!!Form::text('title', null, ['class' => 'form-control','placeholder' => 'Titulo']) !!}	
						</div>


						<div class="form-group col-sm-6">
							{!!Form::select('status', ['1' => 'Ativo',  '2' => 'Inativo'], null, ['class' => 'form-control', 'placeholder' => "Selecione"]) !!}	
						</div>

					</div>

					<div class="pull-left">
						<button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-search"></i> Buscar</button>
						<a href="{!!route('cms-adverts-create')!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Novo Banner</a>
					</div>
					{!! Form::close() !!}

					<div class="pull-right">
						
						<a href="{!!route('cms-advertisers')!!}" class="btn btn-dark btn-sm"><i class="ti-user"></i> Anunciantes</a>
						<a href="{!!route('cms-adverts-locations')!!}" class="btn btn-danger btn-sm"><i class="ti-plug"></i> Módulos</a>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Listagem de Banners</h4>
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Banner</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Cliente / <strong>Titulo</strong></th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Local</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Inicio e Fim</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr>
						</thead>
						<tbody>
							@foreach($adverts as $value)
							<tr>
								<td>img</td>
								<td>{!!$value->advertiser->title!!} / <strong>{!!$value->title!!}</strong></td>
								<td>{!!$value->location->title!!} </td>
								<td>∞ & ∞</td>
								<td class="" width="165">
									@if($value->status == 1)
									<a title="Status: Ativo" href="{!!route('cms-adverts-status', array($value->ad_banners_id, "desativar"))!!}" class="btn waves-effect waves-light btn-light"> 
										<i class="ti-check"></i> 
									</a>
									@elseif($value->status == 2)
									<a title="Status: Inativo" href="{!!route('cms-adverts-status', array($value->ad_banners_id, "ativar"))!!}" class="btn waves-effect waves-light btn-light"> 
										<i class="ti-close"></i> 
									</a>
									@endif
									
									<a title="Editar" href="{!!route('cms-adverts-show', $value->ad_banners_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="ti-pencil"></i> </a>
									<a title="Apagar" href="{!!route('cms-adverts-delete', $value->ad_banners_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div> 
	</div>

</div>

@endsection 