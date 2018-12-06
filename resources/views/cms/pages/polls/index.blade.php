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
						<li class="breadcrumb-item active" aria-current="page">Enquestes</li>
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
					{!! Form::open(['method' => 'get', 'autocomplete' => 'on', 'route' => ['cms-polls']]) !!}
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
						<a href="{!!route('cms-polls-create')!!}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Nova Enquete</a>
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
					<h4 class="card-title">Listagem de Enquetes</h4>
					<table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
						<thead>
							<tr>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Pergunta</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Visualizações</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Votos</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="persist">Inicio e Fim</th>
								<th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="2">Ações</th>
							</tr>
						</thead>
						<tbody> 
							@foreach($polls as $value)
							<tr>
								<td>{!!$value->question!!}</td>
								<td>{!!$value->view!!} </td>
								<td>{!!$value->questions()->sum('votes')!!} </td>
								<td>
									@if($value->start_date != '')
									{!!$value->start_date!!} á {!!$value->end_date!!} 
									@else
									Ilimitado
									@endif
								</td>
								<td class="" width="165">
									@if($value->status == 1)
									<a title="Status: Ativo" href="{!!route('cms-polls-status', array($value->polls_id, "desativar"))!!}" class="btn waves-effect waves-light btn-success"> 
										<i class="ti-check"></i> 
									</a>
									@elseif($value->status == 2)
									<a title="Status: Inativo" href="{!!route('cms-polls-status', array($value->polls_id, "ativar"))!!}" class="btn waves-effect waves-light btn-danger"> 
										<i class="ti-close"></i> 
									</a>
									@endif
									@if($value->show == 1)
									<a title="Status: Ativo" href="{!!route('cms-polls-exibhtion', array($value->polls_id, "ocultar"))!!}" class="btn waves-effect waves-light btn-light"> 
										<i class="fas fa-eye"></i>
									</a>
									@elseif($value->show == 2)
									<a title="Status: Inativo" href="{!!route('cms-polls-exibhtion', array($value->polls_id, "exibir"))!!}" class="btn waves-effect waves-light btn-light"> 
										<i class="far fa-eye-slash"></i> 
									</a>
									@endif
									<a title="Opçoes" href="{!!route('cms-polls-questions', $value->polls_id)!!}" class="btn waves-effect waves-light btn-dark"> <i class="fas fa-question-circle"></i> </a>
									
									<a title="Editar" href="{!!route('cms-polls-show', $value->polls_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="ti-pencil"></i> </a>
									<a title="Apagar" href="{!!route('cms-polls-delete', $value->polls_id)!!}" class="btn waves-effect waves-light btn-light"> <i class="icon-trash"></i> </a>
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