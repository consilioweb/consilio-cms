@extends('cms.layouts._default')
@section('content')


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
						<li class="breadcrumb-item active" aria-current="page">Anuncios</li>
						<li class="breadcrumb-item active" aria-current="page">Anunciantes</li>
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
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-advertisers']]) !!}
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
						<a href="{!!route('cms-advertisers-create')!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Novo Anunciante</a>
					</div>
					{!! Form::close() !!}

					<div class="pull-right">
						
						<a href="{!!route('cms-adverts')!!}" class="btn btn-dark btn-sm"><i class=" ti-ticket"></i> Anuncios</a>
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
					<h4 class="card-title">Listagem de Anunciantes</h4>
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Anunciante </th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Cadastro</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Telefone</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Prioridade</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr> 
						</thead>
						<tbody>
							@foreach($advertisers as $value)
							<tr>
								<td><strong>{!!$value->title!!}</strong></td>
								<td>{!!extractDate($value->created_at)!!} </td>
								<td>{!!$value->phone!!}</td>
								<td>{!!$value->priority()!!} </td>
								<td class="" width="165">
									@if($value->status == 1)
									<a title="Status: Ativo" href="{!!route('cms-advertisers-status', array($value->ad_clients_id, "desativar"))!!}" class="btn waves-effect waves-light btn-success"> 
										<i class="ti-check"></i> 
									</a>
									@elseif($value->status == 2)
									<a title="Status: Inativo" href="{!!route('cms-advertisers-status', array($value->ad_clients_id, "ativar"))!!}" class="btn waves-effect waves-light btn-danger"> 
										<i class="ti-close"></i> 
									</a>
									@endif
									
									<a title="Editar" href="{!!route('cms-advertisers-show', $value->ad_clients_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="ti-pencil"></i> </a>
									<a title="Apagar" href="{!!route('cms-advertisers-delete', $value->ad_clients_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </a>
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