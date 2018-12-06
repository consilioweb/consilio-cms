@extends('cms.layouts._default')
@section('content')


<div class="page-breadcrumb">
	<div class="row">
		<div class="col-5 align-self-center">
			<h4 class="page-title">Enquetes</h4>
		</div>
		<div class="col-7 align-self-center">
			<div class="d-flex align-items-center justify-content-end">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{!!route('cms-dashboard')!!}">Dashboard</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">Newsletters</li>
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
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-newsletters']]) !!}
					<div class="row">

						<div class="form-group col-sm-6">
							{!!Form::text('email', null, ['class' => 'form-control','placeholder' => 'E-mail']) !!}	
						</div>


						<div class="form-group col-sm-6">
							{!!Form::select('status', ['1' => 'Ativo',  '2' => 'Inativo'], null, ['class' => 'form-control', 'placeholder' => "Selecione"]) !!}	
						</div>

					</div>

					<div class="pull-left">
						<button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-search"></i> Buscar</button>					
						<a href="{!!route('cms-newsletters-report')!!}" class="btn btn-secondary btn-sm"><i class="ti-stats-up"></i> Gerar Relatório</a>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Listagem de Newsletter</h4>
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Nome</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Email</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Criado em</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr>
						</thead>
						<tbody> 
							@foreach($newsletters as $value)
							<tr>
								<td>{!!$value->name!!}</td>
								<td>{!!$value->email!!} </td>
								<td>{!!$value->created_at!!} </td>
								<td class="" width="165">
									@if($value->status == 1)
									<a title="Status: Ativo" href="{!!route('cms-newsletters-status', array($value->newsletters_id, "desativar"))!!}" class="btn waves-effect waves-light btn-success"> 
										<i class="ti-check"></i> 
									</a>
									@elseif($value->status == 2)
									<a title="Status: Inativo" href="{!!route('cms-newsletters-status', array($value->newsletters_id, "ativar"))!!}" class="btn waves-effect waves-light btn-danger"> 
										<i class="ti-close"></i> 
									</a>
									@endif									
									<a title="Apagar" href="{!!route('cms-newsletters-delete', $value->newsletters_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </a>
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