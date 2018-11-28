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
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Titulo - <strong>Cliente</strong></th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Local</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Inicio e Fim</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>img</td>
								<td>Full Banner - <strong>Big Lojas</strong></td>
								<td>Lateral do Site 250x250</td>
								<td>∞ & ∞</td>
								<td class="" width="165">
									<a title="Status: Ativo" href="#" class="btn waves-effect waves-light btn-light"> 
										<i class="ti-check"></i> 
									</a>
									
									<button title="Apagar" type="button" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </button>
									<button title="Editar" type="button" class="btn waves-effect waves-light btn-light"> <i class="ti-pencil"></i> </button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div> 
	</div>

</div>

@endsection 