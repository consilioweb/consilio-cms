@extends('cms.layouts._default')

@section('content')	



<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Categorias</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Categorias</li>
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
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-categories']]) !!}
					<div class="row">

						<div class="form-group col-sm-6">
							{!!Form::text('module', null, ['class' => 'form-control','placeholder' => 'Titulo']) !!}	
						</div>

						<div class="form-group col-sm-6">
							{!!Form::select('status', ['1' => 'Ativo',  '2' => 'Inativo'], null, ['class' => 'form-control', 'placeholder' => "Selecione"]) !!}	
						</div>

					</div>

					<button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-search"></i> Buscar</button>
					<a href="{!!route('cms-categories-create')!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Novo</a>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<h5 class="text-theme">Listagem de Categorias</h5>
					<div class="table-responsive">
						<table class="table  table-sm">
							<thead>
								<tr>
									<th width="10">ID</th>
									<th>Categoria</th>
									<th>Modulo</th>
									<th>Cadastrado em</th>
									<th width="20">Status</th>
									<th width="20">Editar</th>
									<th width="20">Excluir</th>
								</tr>
							</thead>
							<tbody>
								@foreach($categories as $value)

								<tr>
									<td>{!!$value->categories_id!!}</td>
									<td>{!!$value->title!!}</td>
									<td>{!!$value->module->module!!}</td>
									<td>
										<i class="fa fa-calendar-o" aria-hidden="true"></i> {!!extractDate($value->created_at)!!} às 
										<i class="fa fa-clock-o" aria-hidden="true"></i> {!!extrateHour($value->created_at)!!}
									</td>
									<td>
										@if($value->status == 1)
										<a href="{!!route('cms-categories-status', array($value->categories_id, "desativar"))!!}" class="btn btn-theme ">
											{!!$value->status()!!}
										</a>
										@elseif($value->status == 2)
										<a href="{!!route('cms-categories-status', array($value->categories_id, "ativar"))!!}" class="btn btn-theme ">
											{!!$value->status()!!}
										</a>
										@endif
									</td>
									<td>
										<a href="{!!route('cms-categories-update', $value->categories_id)!!}" class="btn btn-theme ">
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</a>
									</td>
									<td>
										<a href="{!!route('cms-categories-delete', $value->categories_id)!!}" class="btn btn-theme ">
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
		</div>
	</div>
</div>


@endsection 