@extends('cms.layouts._default')

@section('content')	


<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Usuários</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Usuários</li>
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
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-users']]) !!}
					<div class="row">

						<div class="form-group col-sm-6">
							{!!Form::text('name', null, ['class' => 'form-control','placeholder' => 'Nome']) !!}	
						</div>

						<div class="form-group col-sm-6">
							{!!Form::select('status', ['1' => 'Ativo',  '2' => 'Inativo'], null, ['class' => 'form-control', 'placeholder' => "Selecione"]) !!}	
						</div>

					</div>

					<button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-search"></i> Buscar</button>
					<a href="{!!route('cms-users-create')!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Novo</a>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Listagem de Usuários</h4>
					
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">ID</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Nome</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Nivel</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Último Acesso</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $value)
							<tr>
								<td>{!!$value->users_id!!}</td>
								<td>{!!$value->first_name . " " . $value->last_name!!}</td>
								<td>{!!$value->nivel()!!}</td>								
								<td>
									<i class="fa fa-calendar-o" aria-hidden="true"></i> {!!extractDate($value->last_acess)!!} às 
									<i class="fa fa-clock-o" aria-hidden="true"></i> {!!extrateHour($value->last_acess)!!}
								</td>								
								<td class="" width="165">
									@if($value->status == 1)
									<a title="Status: Ativo" href="{!!route('cms-users-status', array($value->users_id, "desativar"))!!}" class="btn waves-effect waves-light btn-light"> 
										<i class="ti-check"></i> 
									</a>
									@elseif($value->status == 2)
									<a title="Status: Inativo" href="{!!route('cms-users-status', array($value->users_id, "ativar"))!!}" class="btn waves-effect waves-light btn-light"> 
										<i class="ti-close"></i> 
									</a>
									@endif
									
									<a title="Editar" href="{!!route('cms-users-show', $value->users_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="ti-pencil"></i> </a>
									<a title="Apagar" href="{!!route('cms-users-delete', $value->users_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- Column -->
		</div>
	</div>
</div>


@endsection 