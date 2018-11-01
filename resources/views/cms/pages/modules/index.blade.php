@extends('cms.layouts._default')

@section('content')	



<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Módulos</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Módulos</li>
					</ol>
				</nav>
			</div>
		</div>
	</div> 
</div>


<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<!-- Alerts -->
			@include('cms.layouts._alerts')
			<div class="card">
				<div class="card-body">
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-modules']]) !!}
					<div class="row">

						<div class="form-group col-sm-6">
							{!!Form::text('module', null, ['class' => 'form-control','placeholder' => 'Titulo']) !!}	
						</div>

						<div class="form-group col-sm-6">
							{!!Form::select('status', ['1' => 'Ativo',  '2' => 'Inativo'], null, ['class' => 'form-control', 'placeholder' => "Selecione"]) !!}	
						</div>

					</div>

					<button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-search"></i> Buscar</button>
					<a href="{!!route('cms-modules-create')!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Novo</a>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="text-theme">Listagem de Modulos</h5>
					<div class="table-responsive">
						<table class="table  table-sm">
							<thead>
								<tr>
									<th width="10">ID</th>
									<th>Módulo</th>
									<th>Tipo de Módulo</th>
									<th width="20">Status</th>
									<th width="20">Editar</th>
									<th width="20">Excluir</th>
								</tr>
							</thead>
							<tbody>
								@foreach($modules as $value)
								<tr>
									<td>{!!$value->modules_id!!}</td>
									<td><h6>{!!$value->module!!}</h6></td>
									<td>{!!$value->type_module()!!}</td>
									<td>
										@if($value->status == 1)
										<a href="{!!route('cms-modules-status', array($value->modules_id, "desativar"))!!}" class="btn btn-theme ">
											{!!$value->status()!!}
										</a>
										@elseif($value->status == 2)
										<a href="{!!route('cms-modules-status', array($value->modules_id, "ativar"))!!}" class="btn btn-theme ">
											{!!$value->status()!!}
										</a>
										@endif
									</td>
									<td>
										<a href="{!!route('cms-modules-update', $value->modules_id)!!}" class="btn btn-theme ">
											<i class="fas fa-pencil-alt" aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<a href="{!!route('cms-modules-delete', $value->modules_id)!!}" class="btn btn-theme ">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Column -->
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Listagem de Modulos</h4>
					
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">ID</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Módulo</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Tipo do Modulo</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr>
						</thead>
						<tbody>
							@foreach($modules as $value)
							<tr>
								<td>{!!$value->modules_id!!}</td>
								<td>{!!$value->module!!}</td>
								<td>{!!$value->type_module()!!}</td>								
								<td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;"><button class="jsgrid-button jsgrid-edit-button" type="button" title="Edit"></button><button class="jsgrid-button jsgrid-delete-button" type="button" title="Delete"></button></td>
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